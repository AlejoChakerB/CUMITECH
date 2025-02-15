<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecardRequest;
use App\Http\Requests\UpdatecardRequest;
use App\Repositories\cardRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\employe;
use App\Models\card;
use Illuminate\Support\Facades\Redirect;
use Flash;
use Response;
use PDF;

class cardController extends AppBaseController
{
    /** @var cardRepository $cardRepository*/
    private $cardRepository;

    public function __construct(cardRepository $cardRepo)
    {
        $this->cardRepository = $cardRepo;
    }

    /**
     * Display a listing of the card.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_cards');

        
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $employeesQuery = Employe::query();

        if (!empty($search)) {
            $employeesQuery->where('unit', '!=', 'Deshabilitado')
                ->where(function ($query) use ($search) {
                    $query->where('dni', 'LIKE', '%' . $search . '%')
                        ->orWhere('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('work_position', 'LIKE', '%' . $search . '%');
                });
        }else {
            $employeesQuery->where('unit', '!=', 'pendiente')
            ->Where('unit', '!=', 'Deshabilitado')
            ->get();
        }

        $employees = $employeesQuery->orderBy('name', 'ASC')->paginate($perPage);

        return view('cards.index', compact('employees'));
    }

    /**
     * Show the form for creating a new card.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_cards');
        $employes = Employe::where('unit', '!=', 'pendiente')
                        ->Where('unit', '!=', 'Deshabilitado')
                        ->orderBy('name')
                        ->pluck('name', 'id');
        $today = now()->format('Y-m-d');
        return view('cards.create', compact('employes', 'today'));
    }

    /**
     * Store a newly created card in storage.
     *
     * @param CreatecardRequest $request
     *
     * @return Response
     */
    public function store(CreatecardRequest $request)
    {
        $this->authorize('create_cards');
        $input = $request->all();
        $input['signature_employe_card'] = $request->input('employe_signature');
        $card = $this->cardRepository->create($input);
        $name = Employe::where('id', '=', $card->employe_id)
        ->value('name');
        
        session()->flash('success', "¡¡Carnet registrado al empleado $name!!");
        
        $pdfUrl = route('generar.acta.entrega.card', ['id' => $card->id]);
        
        return redirect()->route('cards.employe', ['id' => $card->employe_id])
        ->with('pdfUrl', $pdfUrl)
        ->with('card', $card);
    }

    /**
     * Display the specified card.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_cards');
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            Flash::error('Tarjeta no encontrada');

            return redirect(route('cards.index'));
        }

        $pdfUrl = route('generar.acta.entrega.card', ['id' => $card->id]);

        return redirect()->back()->with('pdfUrl', $pdfUrl);
    }

    public function showEmploye($id)
    {
        $this->authorize('view_cards');
        $employee = Employe::findOrFail($id);
        $cards = $employee->cards;

        return view('cards.card_show_employe')
            ->with('employee', $employee)
            ->with('cards', $cards);
    }

    /**
     * Show the form for editing the specified card.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_cards');
        $card = $this->cardRepository->find($id);
        $employes = Employe::pluck('name', 'id');
        $signature = $card->signature_employe_card;
        $today = $card->delivery_date_card;
        if (empty($card)) {
            Flash::error('Tarjeta no encontrada');

            return redirect(route('cards.index'));
        }

        return view('cards.edit', compact('employes', 'signature', 'today'))->with('card', $card);
    }

    /**
     * Update the specified card in storage.
     *
     * @param int $id
     * @param UpdatecardRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecardRequest $request)
    {
        $this->authorize('update_cards');
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            Flash::error('Tarjeta no encontrada');

            return redirect(route('cards.index'));
        }
        $input = $request->all();
        $input['signature_employe_card'] = $request->input('employe_signature');
        
        $name = Employe::where('id', '=', $card->employe_id)
        ->value('name');
        
        $this->cardRepository->update($input, $id);

        session()->flash('success', "¡¡Entrega de carnet modificada al empleado $name!!");

        $pdfUrl = route('generar.acta.entrega.card', ['id' => $card->id]);

        return redirect()->route('cards.employe', ['id' => $card->employe_id])
        ->with('pdfUrl', $pdfUrl)
        ->with('card', $card);
    }

    /**
     * Remove the specified card from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_cards');
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            Flash::error('Tarjeta no encontrada');

            return redirect(route('cards.index'));
        }

        $this->cardRepository->delete($id);

        session()->flash('success', "¡¡Registro de carnet eliminado con exito!!");

        return redirect()->back();
    }

    public function generarActaEntregaCard($id)
    {
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            Flash::error('employe not found');
            return redirect(route('card.create'));
        }

        // Obtener los datos necesarios del endowment
        $id = $card->id;
        $employeId = $card->employe_id;
        $deliverDate = $card->delivery_date_card;
        $signature = $card->signature_employe_card;
        // Obtener el contrato y el empleado asociado
        $employe = employe::with('cards')->find($employeId);
        $employeeName = $card->employe->name;
        $employeeDni = $card->employe->dni;
        $employeeWork = $card->employe->work_position;
        $employeecost = $card->employe->cost_center;
        $employeeservice = $card->employe->service;


        // Cargar la vista PDF y pasar los datos necesarios
        $pdf = PDF::loadView('cards.acta_entrega_carnet', compact('id','deliverDate','employeId',
        'signature', 'employeeName', 'employeeDni', 'employeeWork', 'employeecost', 'employeeservice'));

        return response($pdf->output())
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="acta_entrega_carnet.pdf"');
    }
}
