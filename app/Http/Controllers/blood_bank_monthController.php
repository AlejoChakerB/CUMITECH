<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createblood_bank_monthRequest;
use App\Http\Requests\Updateblood_bank_monthRequest;
use App\Repositories\blood_bank_monthRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flash;
use Response;
use Carbon\Carbon;
use App\Models\blood_bank_month;
use App\Models\procedures;
use App\Models\general_costs;

use App\Models\SismaSalud\sis_deta;

class blood_bank_monthController extends AppBaseController
{
    /** @var blood_bank_monthRepository $bloodBankMonthRepository*/
    private $bloodBankMonthRepository;

    public function __construct(blood_bank_monthRepository $bloodBankMonthRepo)
    {
        $this->bloodBankMonthRepository = $bloodBankMonthRepo;
    }

    /**
     * Display a listing of the blood_bank_month.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_bloodBankMonths');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $bloodBankMonthsQuery = blood_bank_month::query();

        if (!empty($search)) {
            $bloodBankMonthsQuery->where('cups', 'LIKE', '%' . $search . '%')
            ->orWhereHas('procedures', function ($query) use ($search) {
                $query->where('cups', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%');
            });
        }

        $bloodBankMonths = $bloodBankMonthsQuery->paginate($perPage);
        $first = blood_bank_month::select('period')->first();
        $yearOnly = "";
        if ($first) {
            $yearOnly = date('Y', strtotime($first->period));
        }

        return view('blood_bank_months.index', compact('bloodBankMonths','yearOnly'));
    }

    /**
     * Show the form for creating a new blood_bank_month.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_bloodBankMonths');
        return view('blood_bank_months.create');
    }

    /**
     * Store a newly created blood_bank_month in storage.
     *
     * @param Createblood_bank_monthRequest $request
     *
     * @return Response
     */
    public function store(Createblood_bank_monthRequest $request)
    {
        $input = $request->all();

        $total = $request->input('honorary_bs') + $request->input('log') +  $request->input('admin');
        $input['total_cost'] = $total;

        $bloodBankMonth = $this->bloodBankMonthRepository->create($input);

        Flash::success('Blood Bank Month saved successfully.');

        return redirect(route('bloodBankMonths.index'));
    }

    /**
     * Display the specified blood_bank_month.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_bloodBankMonths');
        $bloodBankMonth = $this->bloodBankMonthRepository->find($id);

        if (empty($bloodBankMonth)) {
            Flash::error('Blood Bank Month not found');

            return redirect(route('bloodBankMonths.index'));
        }

        return view('blood_bank_months.show')->with('bloodBankMonth', $bloodBankMonth);
    }

    /**
     * Show the form for editing the specified blood_bank_month.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_bloodBankMonths');
        $bloodBankMonth = $this->bloodBankMonthRepository->find($id);

        if (empty($bloodBankMonth)) {
            Flash::error('Blood Bank Month not found');

            return redirect(route('bloodBankMonths.index'));
        }

        return view('blood_bank_months.edit')->with('bloodBankMonth', $bloodBankMonth);
    }

    /**
     * Update the specified blood_bank_month in storage.
     *
     * @param int $id
     * @param Updateblood_bank_monthRequest $request
     *
     * @return Response
     */
    public function update($id, Updateblood_bank_monthRequest $request)
    {
        $bloodBankMonth = $this->bloodBankMonthRepository->find($id);

        $input = $request->all();

        $log = General_costs::where('code', 14)->first();
        $admin = General_costs::where('code', 13)->first();
        $total_sum = blood_bank_month::sum('average_value');
        $partic = $input['average_value']/$total_sum;
        $logistic = ($partic * $log->value)/$bloodBankMonth->total_months;
        $admininstrative = ($partic * $admin->value)/$bloodBankMonth->total_months;
        $honorary = $input['honorary_bs'];
        $total = $honorary + $logistic + $admininstrative;

        $input['total_cost'] = $total;

        if (empty($bloodBankMonth)) {
            Flash::error('Blood Bank Month not found');

            return redirect(route('bloodBankMonths.index'));
        }

        $bloodBankMonth = $this->bloodBankMonthRepository->update($input, $id);

        Flash::success('Blood Bank Month updated successfully.');

        return redirect(route('bloodBankMonths.index'));
    }

    /**
     * Remove the specified blood_bank_month from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_bloodBankMonths');
        $bloodBankMonth = $this->bloodBankMonthRepository->find($id);

        if (empty($bloodBankMonth)) {
            Flash::error('Blood Bank Month not found');

            return redirect(route('bloodBankMonths.index'));
        }

        $this->bloodBankMonthRepository->delete($id);

        Flash::success('Blood Bank Month deleted successfully.');

        return redirect(route('bloodBankMonths.index'));
    }

    public function countBlood()
    {
        $this->authorize('create_bloodBankMonths');
        // Obtener el año actual
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        if ($currentMonth == 1) {
            $currentYear = Carbon::now()->subYear()->year;
        }
        // Crear un array con los meses del año actual
        $months = range(1, date('n')-1);
        // Inicializar un array para almacenar los resultados
        $results = [];

        foreach ($months as $month) {
            $monthResults = sis_deta::join('sis_maes', 'sis_maes.con_estudio', '=', 'sis_deta.estudio')
            ->leftJoin('sis_tipo', 'sis_tipo.fuente', '=', 'sis_deta.fuente_tips')
            ->leftJoin('Ufuncionales', 'Ufuncionales.id', '=', 'sis_deta.ufuncional')
            ->join('contratos', 'contratos.codigo', '=', 'sis_maes.contrato')
            ->where('sis_maes.estado', 'C')
            ->whereYear('sis_maes.fecha_egreso', $currentYear)
            ->whereMonth('sis_maes.fecha_egreso', $month)
            ->where('sis_deta.total', '>', 0)
            ->where('sis_maes.nro_factura', '>', 0)
            ->where('sis_deta.Cod_centro_costo', 'UT-001')
            ->where('cod_servicio', '!=', '939403')
            ->groupBy('sis_deta.Cod_servicio', 'sis_deta.Descripcion')
            ->select('sis_deta.Cod_servicio', 'sis_deta.Descripcion', DB::raw('SUM(sis_deta.cantidad) AS Cantidad'), DB::raw('SUM(sis_deta.total) AS Total'), DB::raw("'" . $month . "' Period"))
            ->orderByDesc(DB::raw('SUM(sis_deta.total)'))
            ->get();
            //dd($monthResults);
            $results = array_merge($results, $monthResults->toArray());
        }
        $newResults = $this->validateProcedure($results);

        foreach ($newResults as $newResult) {
            $nameMonth = strtolower(Carbon::createFromDate(null, $newResult['Period'], null)->format('F'));
            $nameMonthValue = $this->nameValue($nameMonth);
            $production = blood_bank_month::where('cups', $newResult['Cod_servicio'])
            ->where('period', (string) $currentYear)
            ->first();
            
            if ($production) {
                $production->update([
                    'period' => $currentYear,
                    $nameMonth => $newResult['Cantidad'],
                    $nameMonthValue => $newResult['Total'],
                    'cups' => $newResult['Cod_servicio'],
                    'observation' => $newResult['Observation']
                ]);
            }else {
                blood_bank_month::create([
                    'period' => $currentYear,
                    $nameMonth => $newResult['Cantidad'],
                    $nameMonthValue => $newResult['Total'],
                    'cups' => $newResult['Cod_servicio'],
                    'observation' => $newResult['Observation']
                ]);
            }
        }
        $this->calculate();
        session()->flash('success', "¡¡Produccion de banco de sangre actualizado correctamente!!");
        return redirect(route('bloodBankMonths.index'));
    }

    public function calculate(){
        $this->authorize('create_bloodBankMonths');
        $productions = blood_bank_month::all();
        foreach ($productions as $production) {
            $month = array_filter([
                'january' => $production->january,
                'february' => $production->february,
                'march' => $production->march,
                'april' => $production->april,
                'may' => $production->may,
                'june' => $production->june,
                'july' => $production->july,
                'august' => $production->august,
                'september' => $production->september,
                'october' => $production->october,
                'november' => $production->november,
                'december' => $production->december,
            ], function ($value) {
                return !is_null($value) && $value !== '';
            }, ARRAY_FILTER_USE_BOTH);

            $monthValue = array_filter([
                'january_value' => $production->january_value,
                'february_value' => $production->february_value,
                'march_value' => $production->march_value,
                'april_value' => $production->april_value,
                'may_value' => $production->may_value,
                'june_value' => $production->june_value,
                'july_value' => $production->july_value,
                'august_value' => $production->august_value,
                'september_value' => $production->september_value,
                'october_value' => $production->october_value,
                'november_value' => $production->november_value,
                'december_value' => $production->december_value,
            ], function ($value) {
                return !is_null($value) && $value !== '';
            }, ARRAY_FILTER_USE_BOTH);
            // Contar los meses no nulos
            $quanty_month = count($month);
            $total_month = array_sum($month);
            $total_valueMonth = array_sum($monthValue);
            $average_month = $total_month/$quanty_month;
            $average_ValueMonth = $total_valueMonth/$quanty_month;
            $unit_price = $total_valueMonth/$total_month;
            $production->update([
                'total_months' => $total_month,
                'total_value' => $total_valueMonth,
                'average_value' =>$average_ValueMonth,
                'average_months' => $average_month,
                'unit_price' => $unit_price
            ]);        
        }
    }

    public function nameValue($value)
    {
        switch ($value) {
            case 'january':
                return 'january_value';
                break;
            case 'february':
                return 'february_value';
                break;
            case 'march':
                return 'march_value';
                break;
            case 'april':
                return 'april_value';
                break;
            case 'may':
                return 'may_value';
                break;
            case 'june':
                return 'june_value';
                break;
            case 'july':
                return 'july_value';
                break;
            case 'august':
                return 'august_value';
                break;
            case 'september':
                return 'september_value';
                break;
            case 'october':
                return 'october_value';
                break;
            case 'november':
                return 'november_value';
                break;
            case 'december':
                return 'december_value';
                break;
        }
    }

    
    public function validateProcedure($results)
    {
        $groupedResults = [];

        foreach ($results as $result) {
            $observation = "";
            $period = $result['Period'];
            $description = $result['Descripcion'];
            $procedure = Procedures::where('code', $result['Cod_servicio'])
                ->where('manual_type', 'SOAT')->first();
            if (!$procedure) {
                $procedure = Procedures::where('cups', $result['Cod_servicio'])
                ->where('manual_type', 'SOAT')->first();
                if (!$procedure) {
                    $ProcedureCode = $result['Cod_servicio'];
                    $observation = "NO HOMOLOGADO";
                }else {
                    $ProcedureCode = $procedure->code;
                    $description = $procedure->description;
                }
            }else {
                $ProcedureCode = $procedure->code;
                $description = $procedure->description;
            }

            $key = $ProcedureCode . '_' . $period;

            if (isset($groupedResults[$key])) {
                $groupedResults[$key]['Cantidad'] += $result['Cantidad'];
                $groupedResults[$key]['Total'] += $result['Total'];
            } else {
                $groupedResults[$key] = [
                    'Cod_servicio' => $ProcedureCode,
                    'Descripcion' => $description,
                    'Cantidad' => $result['Cantidad'],
                    'Total' => $result['Total'],
                    'Period' => $period,
                    'Observation' => $observation,
                ];
            }
        }

        // Eliminar elementos duplicados
        $groupedResults = array_unique($groupedResults, SORT_REGULAR);
        return $groupedResults;
    }

    public function calculateBlood(){
        $this->authorize('create_bloodBankMonths');
        $rates = blood_bank_month::all();
        $total_sum = blood_bank_month::sum('average_value');
        $log = General_costs::where('code', 14)->first();
        $admin = General_costs::where('code', 13)->first();
        foreach ($rates as $rate) {
            $partic = $rate->average_value/$total_sum;
            $logistic = ($partic * $log->value)/$rate->total_months;
            $admininstrative = ($partic * $admin->value)/$rate->total_months;
            $honorary = $rate->honorary_bs;
            $total = $honorary + $logistic + $admininstrative;
            $rate->update([
                'participe' => $partic*100,
                'log' => $logistic,
                'admin' => $admininstrative,
                'total_cost' => $total
            ]);
        }

        session()->flash('success', "Costos calculados correctamente!!");
        return redirect(route('bloodBankMonths.index'));
    }
    
}
