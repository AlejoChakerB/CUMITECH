<?php

namespace App\Http\Controllers;

use App\Http\Requests\Creatediferential_ratesRequest;
use App\Http\Requests\Updatediferential_ratesRequest;
use App\Repositories\diferential_ratesRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Diferential_rates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Flash;
use Response;

use App\Models\doctors;
use App\Models\procedures;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CalendarsImport;

class diferential_ratesController extends AppBaseController
{
    /** @var diferential_ratesRepository $diferentialRatesRepository*/
    private $diferentialRatesRepository;

    public function __construct(diferential_ratesRepository $diferentialRatesRepo)
    {
        $this->diferentialRatesRepository = $diferentialRatesRepo;
    }

    /**
     * Display a listing of the diferential_rates.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_diferentialRates');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $diferentialRatesQuery = Diferential_rates::query();

        if (!empty($search)) {
            $diferentialRatesQuery->where('value1', 'LIKE', '%' . $search . '%')
                        ->orWhere('value2', 'LIKE', '%' . $search . '%')
                        ->orWhere('id_doctor', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('doctors', function ($query) use ($search) {
                            $query->where('dni', 'LIKE', '%' . $search . '%')
                            ->orWhere('full_name', 'LIKE', '%' . $search . '%')
                            ->orWhere('code', 'LIKE', '%' . $search . '%');
                        })
                        ->orWhereHas('procedures', function ($query) use ($search) {
                            $query->where('code', 'LIKE', '%' . $search . '%')
                            ->orWhere('cups', 'LIKE', '%' . $search . '%')
                            ->orWhere('description', 'LIKE', '%' . $search . '%');
                        });
        }

        $diferentialRates = $diferentialRatesQuery->paginate($perPage);
        $total = Diferential_rates::count();

        return view('diferential_rates.index', compact('diferentialRates', 'total'));
    }

    /**
     * Show the form for creating a new diferential_rates.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_diferentialRates');
        $doctors = Doctors::orderby('full_name')->pluck('full_name', 'code');
        return view('diferential_rates.create', compact('doctors'));
    }

    /**
     * Store a newly created diferential_rates in storage.
     *
     * @param Creatediferential_ratesRequest $request
     *
     * @return Response
     */
    public function store(Creatediferential_ratesRequest $request)
    {
        $this->authorize('create_diferentialRates');
        $input = $request->all();
        //dd($request->id_doctor);
        $validate = Diferential_rates::where('id_doctor', $input['id_doctor'])
        ->where('id_procedure', $input['id_procedure'])
        ->first();
        if ($validate) {
            session()->flash('error', "¡¡LA TARIFA DIFERENCIAL ASOCIADA AL MÉDICO YA EXISTE!!");
            return redirect(route('diferentialRates.index'));
        }
        $diferentialRates = $this->diferentialRatesRepository->create($input);
        $name = doctors::select('full_name')->where('code', $request->id_doctor)->first();
        //dd($name->full_name);
        session()->flash('success', "¡¡TARIFA DEL MÉDICO $name->full_name REGISTRADA CORRECTAMENTE!!");

        return redirect(route('diferentialRates.index'));
    }

    /**
     * Display the specified diferential_rates.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_diferentialRates');
        $diferentialRates = $this->diferentialRatesRepository->find($id);

        if (empty($diferentialRates)) {
            Flash::error('Diferential Rates not found');

            return redirect(route('diferentialRates.index'));
        }

        return view('diferential_rates.show')->with('diferentialRates', $diferentialRates);
    }

    /**
     * Show the form for editing the specified diferential_rates.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_diferentialRates');
        $diferentialRates = $this->diferentialRatesRepository->find($id);
        
        //dd($diferentialRates);
        $doctors = Doctors::orderby('full_name')->pluck('full_name', 'code');
        $procedure = Procedures::find($diferentialRates->id_procedure);

        $proc = collect([$procedure])->map(function ($procedure) {
            return [
                $procedure->id => $procedure->description . ' (CUPS: ' . $procedure->cups . " - " . $procedure->manual_type . ')'
            ];
        })->first();

        Log::info($proc);
        if (empty($diferentialRates)) {
            Flash::error('Diferential Rates not found');

            return redirect(route('diferentialRates.index'));
        }
    
        return view('diferential_rates.edit', compact('diferentialRates', 'doctors', 'proc', 'procedure'));
    }

    /**
     * Update the specified diferential_rates in storage.
     *
     * @param int $id
     * @param Updatediferential_ratesRequest $request
     *
     * @return Response
     */
    public function update($id, Updatediferential_ratesRequest $request)
    {
        $this->authorize('update_diferentialRates');
        $input = $request->all();
        $diferentialRates = $this->diferentialRatesRepository->find($id);

        $validate = Diferential_rates::where('id_doctor', $input['id_doctor'])
        ->where('id_procedure', $input['id_procedure'])
        ->where('id', '!=' ,$diferentialRates->id)
        ->first();
        if ($validate) {
            session()->flash('error', "¡¡LA TARIFA DIFERENCIAL ASOCIADA AL MÉDICO YA EXISTE!!");
            return redirect(route('diferentialRates.index'));
        }
        if (empty($diferentialRates)) {
            Flash::error('Diferential Rates not found');

            return redirect(route('diferentialRates.index'));
        }

        $diferentialRates = $this->diferentialRatesRepository->update($input, $id);
        $name = doctors::select('full_name')->where('code', $request->id_doctor)->first();
        session()->flash('success', "¡¡TARIFA DEL MÉDICO $name->full_name ACTUALIZADA CORRECTAMENTE!!");

        return redirect(route('diferentialRates.index'));
    }

    /**
     * Remove the specified diferential_rates from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_diferentialRates');
        $diferentialRates = $this->diferentialRatesRepository->find($id);

        if (empty($diferentialRates)) {
            Flash::error('Diferential Rates not found');

            return redirect(route('diferentialRates.index'));
        }

        $this->diferentialRatesRepository->delete($id);
        $name = doctors::select('full_name')->where('code', $diferentialRates->id_doctor)->first();
        session()->flash('success', "TARIFA DIFERENCIAL DEL MÉDICO $name->full_name ELIMINADA CORRECTAMENTE!!");

        return redirect(route('diferentialRates.index'));
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        
        try {
            $import = new CalendarsImport();
            Excel::import($import, $file);

            return redirect()->back()->with('success', '¡Archivo importado correctamente!');
        } catch (\Exception $e) {
            // Manejar el error
            return redirect()->back()->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Importación completada');
    }

    public function downloadDiferentialRates()
    {
        $filePath = public_path('Templates/Formato_tarifaDiferencial.xlsx');
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="Patologias.xlsx"',
        ];

        return Response::download($filePath, 'Formato_tarifaDiferencial.xlsx', $headers);
    }
}
