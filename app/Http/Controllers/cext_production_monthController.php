<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createcext_production_monthRequest;
use App\Http\Requests\Updatecext_production_monthRequest;
use App\Repositories\cext_production_monthRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Flash;
use Response;

use App\Models\cext_details;
use App\Models\cext_production_month;
use Carbon\Carbon;
use App\Models\SismaSalud\hcingres;

class cext_production_monthController extends AppBaseController
{
    /** @var cext_production_monthRepository $cextProductionMonthRepository*/
    private $cextProductionMonthRepository;

    public function __construct(cext_production_monthRepository $cextProductionMonthRepo)
    {
        $this->cextProductionMonthRepository = $cextProductionMonthRepo;
    }

    /**
     * Display a listing of the cext_production_month.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_cextProductionMonths');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $cextProductionMonthsQuery = cext_production_month::query();

        if (!empty($search)) {
            $cextProductionMonthsQuery->where('specialty', 'LIKE', '%' . $search . '%');
        }

        $cextProductionMonths = $cextProductionMonthsQuery->paginate($perPage);
        $first = cext_production_month::select('period')->first();
        $yearOnly = date('Y', strtotime($first->period));

        return view('cext_production_months.index', compact('cextProductionMonths', 'yearOnly'));
    }

    /**
     * Show the form for creating a new cext_production_month.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_cextProductionMonths');
        return view('cext_production_months.create');
    }

    /**
     * Store a newly created cext_production_month in storage.
     *
     * @param Createcext_production_monthRequest $request
     *
     * @return Response
     */
    public function store(Createcext_production_monthRequest $request)
    {
        $input = $request->all();

        $cextProductionMonth = $this->cextProductionMonthRepository->create($input);

        session()->flash('success', "¡¡Produccion de la especialidad " . $input['specialty'] . " añadida correctamente!!");

        return redirect(route('cextProductionMonths.index'));
    }

    /**
     * Display the specified cext_production_month.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_cextProductionMonths');
        $cextProductionMonth = $this->cextProductionMonthRepository->find($id);

        if (empty($cextProductionMonth)) {
            Flash::error('Cext Production Month not found');

            return redirect(route('cextProductionMonths.index'));
        }

        return view('cext_production_months.show')->with('cextProductionMonth', $cextProductionMonth);
    }

    /**
     * Show the form for editing the specified cext_production_month.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_cextProductionMonths');
        $cextProductionMonth = $this->cextProductionMonthRepository->find($id);

        if (empty($cextProductionMonth)) {
            Flash::error('Cext Production Month not found');

            return redirect(route('cextProductionMonths.index'));
        }

        return view('cext_production_months.edit')->with('cextProductionMonth', $cextProductionMonth);
    }

    /**
     * Update the specified cext_production_month in storage.
     *
     * @param int $id
     * @param Updatecext_production_monthRequest $request
     *
     * @return Response
     */
    public function update($id, Updatecext_production_monthRequest $request)
    {
        $cextProductionMonth = $this->cextProductionMonthRepository->find($id);
        $input = $request->all();
        if (empty($cextProductionMonth)) {
            Flash::error('Cext Production Month not found');

            return redirect(route('cextProductionMonths.index'));
        }

        $cextProductionMonth = $this->cextProductionMonthRepository->update($input, $id);

        session()->flash('success', "¡¡Produccion de la especialidad " . $input['specialty'] . " actualizada correctamente!!");

        return redirect(route('cextProductionMonths.index'));
    }

    /**
     * Remove the specified cext_production_month from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_cextProductionMonths');
        $cextProductionMonth = $this->cextProductionMonthRepository->find($id);

        if (empty($cextProductionMonth)) {
            Flash::error('Cext Production Month not found');

            return redirect(route('cextProductionMonths.index'));
        }

        $this->cextProductionMonthRepository->delete($id);

        session()->flash('success', "¡¡Produccion de la especialidad " . $cextProductionMonth->specialty . " eliminada correctamente!!");

        return redirect(route('cextProductionMonths.index'));
    }

    public function count(){
        $this->authorize('create_cextProductionMonths');
        // Obtener el año actual
        $currentDate = Carbon::now();
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        if ($currentMonth == 1) {
            $currentYear = Carbon::now()->subYear()->year;
        }
        // Crear un array con los meses del año actual
        $months = [];
        for ($i = 1; $i <= 2; $i++) {
            $month = $currentDate->copy()->subMonths($i)->month;
            $year = $currentDate->copy()->subMonths($i)->year;
            $months[] = ['month' => $month, 'year' => $year];
        }
        // Inicializar un array para almacenar los resultados
        $results = [];

        foreach ($months as $monthData) {
            $month = $monthData['month'];
            $year = $monthData['year'];
            
            $monthResults = hcingres::select(
                'sis_especialidades.nombre',
                DB::raw('COUNT(sis_especialidades.nombre) AS cantidad'), 
                DB::raw("'" . $month . "' Period"),
                DB::raw("'" . $year . "' AS Year")
            )
            ->leftJoin('sis_maes', 'sis_maes.con_estudio', '=', 'hcingres.con_estudio')
            ->leftJoin('sis_medi', 'sis_medi.codigo', '=', 'hcingres.cod_medi')
            ->leftJoin('sis_especialidades', 'sis_especialidades.codigo', '=', 'sis_medi.especialidad')
            ->whereNotIn('hcingres.estado', ['N'])
            ->whereNull('hcingres.FechaAnulacion')
            ->whereYear('hcingres.FechaRegistro', $year)
            ->whereMonth('hcingres.FechaRegistro', $month)
            ->where('sis_maes.ufuncional', '10024')
            ->whereNotIn('sis_maes.estado', ['N'])
            ->where(DB::raw("(SELECT COUNT(*) FROM detalleshc WHERE estudio = hcingres.con_estudio)"), '>', 0)
            ->groupBy('sis_especialidades.nombre')
            ->orderByDesc('cantidad')
            ->get();
            //dd($monthResults);
            $results = array_merge($results, $monthResults->toArray());
        }

        foreach ($results as $result) {
            $nameMonth = strtolower(Carbon::createFromDate($result['Year'], $result['Period'], 1)->format('F'));
            $duration = cext_details::where('specialty', $result['nombre'])->first();
            $production = cext_production_month::where('specialty', $result['nombre'])
            ->where('period', (string) $result['Year'])
            ->first();
            if ($duration) {
                $duration = $duration->duration;
            }else {
                $duration = 0;
            }
            if ($production) {
                $production->update([
                    'specialty' => $result['nombre'],
                    'period' => $result['Year'],
                    $nameMonth => $result['cantidad'],
                    'duration' => $duration,
                ]);
            }else {
                cext_production_month::create([
                    'specialty' =>$result['nombre'],
                    'period' => $result['Year'],
                    $nameMonth => $result['cantidad'],
                    'duration' => $duration,
                ]);
            }
        }
        $this->fusion();
        $this->calculate();
        session()->flash('success', "¡¡Produccion de consulta externa actualizada correctamente!!");
        return redirect(route('cextProductionMonths.index'));
    }

    public function calculate(){
        $productions = cext_production_month::all();
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
        
            // Contar los meses no nulos
            $quanty_month = count($month);
            $total_month = array_sum($month);
            $average_month = $total_month/$quanty_month;
            $totalDuration = $average_month*$production->duration;
            $production->update([
                'average_months' => $average_month,
                'total_duration' => $totalDuration
            ]);        
        }
    }

    public function fusion(){
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        if ($currentMonth == 1) {
            $currentYear = Carbon::now()->subYear()->year;
        }
        $productions = cext_production_month::whereIn('specialty', ['ANESTESIOLOGIA', 'GRUPO DE ANESTESIOLOGIA', 'ANESTESIOLOGIA Y REANIMACION'])->get();
        $months = range(1, date('n')-1);
        foreach ($months as $month) 
        {
            $nameMonth = strtolower(Carbon::createFromDate(null, $month, null)->format('F'));
            $quanty = $productions->sum($nameMonth);
            
            $anest = cext_production_month::where('specialty', 'ANESTESIOLOGIA')->first();
            //Log::info($month . " " . $nameMonth . " " . $quanty);
            if ($anest) 
            {
                $anest->update([
                    $nameMonth => $quanty
                ]);
            }
               
        }

        cext_production_month::whereIn('specialty', ['GRUPO DE ANESTESIOLOGIA', 'ANESTESIOLOGIA Y REANIMACION'])
            ->forceDelete();
    }
}
