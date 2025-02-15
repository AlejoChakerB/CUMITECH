<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateendowmentRequest;
use App\Http\Requests\UpdateendowmentRequest;
use App\Repositories\endowmentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeExport;
use Flash;
use Response;
use PDF;
use App\Models\Employe;
use App\Models\Contracts;
use App\Models\Endowment;
use Carbon\Carbon;

class endowmentController extends AppBaseController
{
    /** @var endowmentRepository $endowmentRepository*/
    private $endowmentRepository;

    public function __construct(endowmentRepository $endowmentRepo)
    {
        $this->endowmentRepository = $endowmentRepo;
    }

    /**
     * Display a listing of the endowment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_endowments');
        $threeMonthsAgo = now()->subMonths(3);
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $contractsQuery = Contracts::query();

        if (!empty($search)) {
            $contractsQuery->where(function ($query) use ($threeMonthsAgo) {
                $query->where('disable', '!=', '3')
                    ->where('salary', '<', 2600000)
                    ->where('start_date_contract', '<=', $threeMonthsAgo);
            })
            ->WhereHas('employe', function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('dni', 'LIKE', '%' . $search . '%')
                    ->orWhere('work_position', 'LIKE', '%' . $search . '%');
            });            
        }else {
            $contractsQuery->join('employes', 'contracts.employe_id', '=', 'employes.id')
            ->where('disable', '!=', 3)
            ->where('salary', '<', 2600000)
            ->where('start_date_contract', '<=', $threeMonthsAgo)
            ->orderBy('employes.name')
            ->get();
        }

        $contracts = $contractsQuery->paginate($perPage);

        return view('endowments.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new endowment.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_endowments');
        // Obtener los empleados que cumplen con los requisitos
        $contracts = Contracts::whereHas('employe', function ($query) {
            // Validar antigüedad mínima de 3 meses
            $threeMonthsAgo = now()->subMonths(3);
            $query->where('start_date_contract', '<=', $threeMonthsAgo);
            
            // Validar salario mínimo
            $minSalary =  2600000;
            $query->where('salary', '<', $minSalary);
            
            // Validar contrato habilitado
            $query->where('disable', '!=', '3');
        })
        ->join('employes', 'contracts.employe_id', '=', 'employes.id')
        ->where('unit', '!=', 'Pendiente')
        ->where('unit', '!=', 'Deshabilitado')
        ->orderBy('employes.name')
        ->pluck('employes.name', 'contracts.id');

        $today = now()->format('Y-m-d');
        
        return view('endowments.create', compact('contracts', 'today'));
    }

    /**
     * Store a newly created endowment in storage.
     *
     * @param CreateendowmentRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->authorize('create_endowments');
        $input = $request->all();
        $contracts = Contracts::find($request->contract_id);
        $name = Employe::where('id', '=', $contracts->employe_id)
        ->value('name');

        // Verificar selección de checkboxes
        if (!$request->has('item') || empty($request->input('item'))) {
            session()->flash('error', "¡¡Debe seleccionar al menos un item!!");
            return redirect()->back();
        }

        $input = $request->except('item');
        $input['item'] = json_encode($request->input('item'));
        $period = $input['period'];

        $validateDate = $this->validationDate($input['period'], $input['deliver_date'], $input['contract_id']);
        if($validateDate == true){
            session()->flash('error', "¡¡El empleado $name tiene menos de 3 meses de antiguedad!!");
            return redirect()->back();
        }

        $existingItems = $this->validationRules2($input['period'], $input['contract_id'], $input['deliver_date'], $input['item']);
        if ($existingItems) {
            $existingItemsString = implode(', ', $existingItems);
            session()->flash('error', "¡¡La entrega de $existingItemsString correspondiente al periodo de {$input['period']} al empleado $name ya existe!!");
            return redirect()->back();
        }else {
            $endowments = $this->endowmentRepository->create($input);
            session()->flash('success', "¡¡Entrega de dotación registrada con éxito al empleado $name!!");
    
            $pdfUrl = route('generar.acta.entrega', ['id' => $endowments->id]);
    
            return redirect()->route('endowment.employe', ['id' => $contracts->employe_id])
            ->with('pdfUrl', $pdfUrl);
        } 
    }


    /**
     * Display the specified endowment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_endowments');
        $endowment = $this->endowmentRepository->find($id);

        if (empty($endowment)) {
            Flash::error('Dotacion no encontrada');

            return redirect(route('endowments.index'));
        }
        
        $pdfUrl = route('generar.acta.entrega', ['id' => $endowment->id]);

        return redirect()->back()->with('pdfUrl', $pdfUrl);
    }

    public function showEmploye($id)
    {
        $this->authorize('view_endowments');
        $employee = Employe::findOrFail($id);
        $endowments = collect();
        foreach ($employee->contracts as $contract) {
            $endowments = $endowments->merge($contract->endowment);
        }

        return view('endowments.endowment_show')
            ->with('employee', $employee)
            ->with('endowments', $endowments);
    }

    /**
     * Show the form for editing the specified endowment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_endowments');
        $endowment = $this->endowmentRepository->find($id);

        $contracts = Contracts::whereHas('employe', function ($query) {
            // Validar antigüedad mínima de 3 meses
            $threeMonthsAgo = now()->subMonths(3);
            $query->where('start_date_contract', '<=', $threeMonthsAgo);
            
            // Validar salario mínimo
            $minSalary =  2600000;
            $query->where('salary', '<', $minSalary);
            
            // Validar contrato habilitado
            $query->where('disable', '!=', '3');
        })
        ->join('employes', 'contracts.employe_id', '=', 'employes.id')
        ->where('unit', '!=', 'Pendiente')
        ->where('unit', '!=', 'Deshabilitado')
        ->orderBy('employes.name')
        ->pluck('employes.name', 'contracts.id');
        $today = $endowment->deliver_date;
        // Obtener los valores seleccionados almacenados en la base de datos
        $selectedItems = json_decode($endowment->item);
        $signature = $endowment->employe_signature;
        if (empty($endowment)) {
            session()->flash('error', "¡¡Empleado no encontrado!!");

            return redirect(route('endowments.index'));
        }

        return view('endowments.edit', compact('contracts', 'selectedItems', 'signature', 'today'))->with('endowment', $endowment);
    }

    /**
     * Update the specified endowment in storage.
     *
     * @param int $id
     * @param UpdateendowmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateendowmentRequest $request)
    {
        $this->authorize('update_endowments');
        $endowment = $this->endowmentRepository->find($id);
        $contracts = Contracts::find($request->contract_id);
        if (empty($endowment)) {
            Flash::error('Endowment not found');
            
            return redirect(route('endowments.index'));
        }
        
        $input = $request->all();
        $input['item'] = json_encode($request->input('item'));
        
        $period = $input['period'];

        $validateDate = $this->validationDate($input['period'], $input['deliver_date'], $input['contract_id']);
        if ($validateDate == true) {
            session()->flash('error', "¡¡El empleado tiene menos de 3 meses de antiguedad!!");
            return redirect()->back();
        }
        $existingItems = $this->validationUpdate($input['period'], $input['contract_id'], $input['deliver_date'], $input['item'], $id);
        if ($existingItems) {
            $existingItemsString = implode(', ', $existingItems);
            session()->flash('error', "¡¡La entrega de $existingItemsString correspondiente al periodo de {$input['period']} ya existe!!");
            return redirect()->back();
        }else {
            $this->endowmentRepository->update($input, $id);
            session()->flash('success', "¡¡Registro de dotación modificada con éxito!!");

            $pdfUrl = route('generar.acta.entrega', ['id' => $endowment->id]);

            return redirect()->route('endowment.employe', ['id' => $contracts->employe_id])
            ->with('pdfUrl', $pdfUrl);
        }
    }

    /**
     * Remove the specified endowment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_endowments');
        $endowment = $this->endowmentRepository->find($id);

        if (empty($endowment)) {
            Flash::error('Endowment not found');

            return redirect(route('endowments.index'));
        }

        $this->endowmentRepository->delete($id);

        session()->flash('success', "¡¡Registro de dotacion eliminado con exito!!");

        return redirect()->back();
    }

    public function generarActaEntrega($id)
    {
        $endowment = $this->endowmentRepository->find($id);

        if (empty($endowment)) {
            Flash::error('Endowment not found');
            return redirect(route('endowments.index'));
        }

        // Obtener los datos necesarios del endowment
        $id = $endowment->id;
        $contractId = $endowment->contract_id;
        $deliverDate = $endowment->deliver_date;
        $item = $endowment->item;
        $period = $endowment->period;
        $signature = $endowment->employe_signature;
        // Obtener el contrato y el empleado asociado
        $contract = Contracts::with('employe')->find($contractId);
        $employeeName = $contract->employe->name;
        $employeeDni = $contract->employe->dni;
        $employeeWork = $contract->employe->work_position;
        $employeeService = $contract->employe->service;


        // Cargar la vista PDF y pasar los datos necesarios
        $pdf = PDF::loadView('endowments.acta_entrega', compact('id','deliverDate','contractId',
        'item', 'period', 'signature', 'employeeName', 'employeeDni', 'employeeWork', 'employeeService'));

        // Retornar el PDF para su visualización en el navegador
        return response($pdf->output())
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="acta_entrega.pdf"');
    }

    public static function validationDate($period, $deliver_date, $id)
    {
        $validate = false;
        $carbonDate = Carbon::parse($deliver_date);

        $start_date = Contracts::select('start_date_contract')
        ->where('id', $id)
        ->first();
        $start_date = $start_date->start_date_contract;

        $year = $carbonDate->format('Y');
        $month = '';
        $day = '01';
        if($period == 'Abril'){$month = '04';}elseif ($period == 'Agosto') {$month = '08';}else {$month = '12';}

        $date = Carbon::parse(sprintf("%s-%s-%s", $year, $month, $day));

        $months_diff = $start_date->diffInMonths($carbonDate);
        $period_diff = $start_date->diffInMonths($date);
        if ($carbonDate->lessThan($start_date) || $months_diff < 3 || $period_diff < 3) {
            $validate = true;
        }
        
        return $validate;
    }

    public static function validationRules2($period, $id, $deliver_date, $item)
    {
        $carbonDate = Carbon::parse($deliver_date);
        $year = $carbonDate->format('Y');
        $items = json_decode($item, true);

        $itemBD = Endowment::select('item')
            ->where('period', $period)
            ->whereYear('deliver_date', $year)
            ->where('contract_id', $id)
            ->pluck('item')
            ->toArray();
        

        $itemBDArray = [];

        foreach ($itemBD as $item2) {
            $decodedItem = json_decode($item2, true);
            $itemBDArray = array_merge($itemBDArray, $decodedItem);
        }

        $existingItems = array_intersect($items, $itemBDArray);
        
        return $existingItems;
    }

    public static function validationUpdate($period, $id, $deliver_date, $item, $idEndowment)
    {
        $carbonDate = Carbon::parse($deliver_date);
        $year = $carbonDate->format('Y');
        $items = json_decode($item, true);
        
        $itemBD = Endowment::select('item')
            ->where('period', $period)
            ->whereYear('deliver_date', $year)
            ->where('contract_id', $id)
            ->where('id', '!=', $idEndowment)
            ->pluck('item')
            ->toArray();
        
            $itemBDArray = [];

        foreach ($itemBD as $item2) {
            $decodedItem = json_decode($item2, true);
            $itemBDArray = array_merge($itemBDArray, $decodedItem);
        }

        $existingItems = array_intersect($items, $itemBDArray);
        
        return $existingItems;
    }

    public function getItems($period, $deliver_date, $id)
    {
        $carbonDate = Carbon::parse($deliver_date);
        $year = $carbonDate->format('Y');
        // Realiza la consulta a la base de datos para obtener los items entregados en el periodo especificado
        $items = Endowment::where('period', $period)
        ->whereYear('deliver_date', $deliver_date)
        ->where('contract_id', $id)
        ->get();

        // Aquí puedes incluir la lógica necesaria para relacionar los items entregados con los empleados correspondientes si es necesario

        return response()->json($items);
    }

    public function export(Request $request) 
    {
        $period = $request->period;
        $year = $request->year;
        return Excel::download(new EmployeExport($period, $year), 'Empleados_' . $period . '_' . $year . '.xlsx');
    }

}