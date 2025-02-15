<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecontractsRequest;
use App\Http\Requests\UpdatecontractsRequest;
use App\Repositories\contractsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Contracts;
use Flash;
use Response;

use App\Models\employe;

class contractsController extends AppBaseController
{
    /** @var contractsRepository $contractsRepository*/
    private $contractsRepository;

    public function __construct(contractsRepository $contractsRepo)
    {
        $this->contractsRepository = $contractsRepo;
    }

    /**
     * Display a listing of the contracts.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_contracts');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $contractsQuery = Contracts::query();

        if (!empty($search)) {
            $contractsQuery->where('salary', 'LIKE', '%' . $search . '%')
                        ->orWhere('start_date_contract', 'LIKE', '%' . $search . '%')
                        ->orWhere('disable', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('employe', function ($query) use ($search) {
                            $query->where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('dni', 'LIKE', '%' . $search . '%');
                        });
        }

        $contracts = $contractsQuery->orderBy('employe_id')->paginate($perPage);

        return view('contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new contracts.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_contracts');
        $employes = Employe::orderby('name')->pluck('name', 'id');
        return view('contracts.create', compact('employes'));
    }

    /**
     * Store a newly created contracts in storage.
     *
     * @param CreatecontractsRequest $request
     *
     * @return Response
     */
    public function store(CreatecontractsRequest $request)
    {
        $this->authorize('create_contracts');
        $input = $request->all();
        $existing = Contracts::where('employe_id', $input['employe_id'])
        ->where('start_date_contract', '<', $input['start_date_contract'])
        ->orderBy('start_date_contract', 'desc')
        ->first();

        if ($existing) {
            // Actualizar el contrato anterior deshabilitándolo
            $existing->disable = "3";
            $existing->save();
        }

        $contracts = $this->contractsRepository->create($input);

        session()->flash('success', "¡¡Contrato registrado con éxito!!");

        return redirect(route('contracts.index'));
    }

    /**
     * Display the specified contracts.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_contracts');
        $contracts = $this->contractsRepository->find($id);

        if (empty($contracts)) {
            Flash::error('Contracts not found');

            return redirect(route('contracts.index'));
        }

        return view('contracts.show')->with('contracts', $contracts);
    }

    /**
     * Show the form for editing the specified contracts.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_contracts');
        $contracts = $this->contractsRepository->find($id);
        $employes = Employe::orderby('name')->pluck('name', 'id');

        if (empty($contracts)) {
            Flash::error('Contracts not found');

            return redirect(route('contracts.index'));
        }

        return view('contracts.edit')
        ->with('contracts', $contracts)
        ->with('employes', $employes);
    }

    /**
     * Update the specified contracts in storage.
     *
     * @param int $id
     * @param UpdatecontractsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecontractsRequest $request)
    {
        $this->authorize('update_contracts');
        $contracts = $this->contractsRepository->find($id);

        if (empty($contracts)) {
            Flash::error('Contracts not found');

            return redirect(route('contracts.index'));
        }

        $contracts = $this->contractsRepository->update($request->all(), $id);

        session()->flash('success', "¡¡Contrato modificado con éxito!!");

        return redirect(route('contracts.index'));
    }

    /**
     * Remove the specified contracts from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_contracts');
        $contracts = $this->contractsRepository->find($id);

        if (empty($contracts)) {
            Flash::error('Contracts not found');

            return redirect(route('contracts.index'));
        }

        $this->contractsRepository->delete($id);

        session()->flash('success', "¡¡Contrato eliminado con éxito!!");

        return redirect(route('contracts.index'));
    }

    public function getContracts()
    {
        $results = DB::connection('sqlsrv')->select("SELECT e.identificacion, e.nombre_completo, 
            c.codigo, ca.descripcion AS cargo, 
            u.descripcion AS UFuncional, c.fecha_inicio_contrato, 
            c.sueldo_basico, c.deshabilitar 
            FROM contratos c
            JOIN empleado e ON c.id_empleado = e.id
            JOIN cargos ca ON ca.id = c.id_cargos
            JOIN unidades_funcionales u ON u.id = c.id_unidades_funcionales
            WHERE ca.codigo NOT IN(29,116,67) AND c.deshabilitar NOT IN(1,3)");
                    
        foreach ($results as $result) {
            // Se valida que el contrato exista
            $idEmploye = Employe::where('dni', $result->identificacion)->first();
            if ($idEmploye) {
                //Se busca el contrato del empleado
                $existingContracts = Contracts::where('start_date_contract', $result->fecha_inicio_contrato)
                    ->where('employe_id', $idEmploye->id)
                    ->first();                
            }else {
                session()->flash('error', "¡¡Empleado con cedula $result->identificacion no encontrado!!");
                return redirect(route('contracts.index'));
            }

            //Si no existe
            if (!$existingContracts) {
                if ($idEmploye) {
                    $existing = Contracts::where('employe_id', $idEmploye->id)
                        ->where('start_date_contract', '<', $result->fecha_inicio_contrato)
                        ->orderBy('start_date_contract', 'desc')
                        ->first();

                    if ($existing) {
                        // Actualizar el contrato anterior deshabilitándolo
                        $existing->disable = "3";
                        $existing->save();
                    }

                    $newContract = new Contracts();
                    $newContract->salary = $result->sueldo_basico;
                    $newContract->start_date_contract = $result->fecha_inicio_contrato;
                    $newContract->disable = '0';
                    $newContract->employe_id = $idEmploye->id;

                    $newContract->save();         
                }
            } else {
                // Actualizar el contrato existente con el nuevo sueldo
                if ($existingContracts->salary != $result->sueldo_basico) {
                    $existingContracts->salary = $result->sueldo_basico;
                    $existingContracts->save();
                }
            }
        }

        session()->flash('success', "¡¡Contratos actualizados con éxito!!");
        return redirect(route('contracts.index'));
    }
}
