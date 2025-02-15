<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createimaging_production_monthRequest;
use App\Http\Requests\Updateimaging_production_monthRequest;
use App\Repositories\imaging_production_monthRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Flash;
use Response;
use Carbon\Carbon;
use Carbon\TranslatorImmutable;

use App\Models\imaging_production_details;
use App\Models\imaging_production_month;
use App\Models\imaging_production;
use App\Models\procedures;
use App\Models\GoTelemedicina\examen_cita_confirmada;
use App\Models\GoTelemedicina\modalidads;

class imaging_production_monthController extends AppBaseController
{
    /** @var imaging_production_monthRepository $imagingProductionMonthRepository*/
    private $imagingProductionMonthRepository;

    public function __construct(imaging_production_monthRepository $imagingProductionMonthRepo)
    {
        $this->imagingProductionMonthRepository = $imagingProductionMonthRepo;
    }

    /**
     * Display a listing of the imaging_production_month.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_imagingProductionMonths');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $imagingProductionMonthsQuery = imaging_production_month::query();

        if (!empty($search)) {
            $imagingProductionMonthsQuery->where('service', 'LIKE', '%' . $search . '%')
            ->orWhereHas('procedures', function ($query) use ($search) {
                $query->where('code', 'LIKE', '%' . $search . '%')
                ->orWhere('cups', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%');
            });
        }

        $imagingProductionMonths = $imagingProductionMonthsQuery->paginate($perPage);
        $first = imaging_production_month::select('period')->first();
        $yearOnly = "";
        if ($first) {
            $yearOnly = date('Y', strtotime($first->period));
        }

        return view('imaging_production_months.index', compact('imagingProductionMonths', 'yearOnly'));
    }

    /**
     * Show the form for creating a new imaging_production_month.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_imagingProductionMonths');
        return view('imaging_production_months.create');
    }

    /**
     * Store a newly created imaging_production_month in storage.
     *
     * @param Createimaging_production_monthRequest $request
     *
     * @return Response
     */
    public function store(Createimaging_production_monthRequest $request)
    {
        $input = $request->all();

        $imagingProductionMonth = $this->imagingProductionMonthRepository->create($input);

        Flash::success('Imaging Production Month saved successfully.');

        return redirect(route('imagingProductionMonths.index'));
    }

    /**
     * Display the specified imaging_production_month.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_imagingProductionMonths');
        $imagingProductionMonth = $this->imagingProductionMonthRepository->find($id);

        if (empty($imagingProductionMonth)) {
            Flash::error('Imaging Production Month not found');

            return redirect(route('imagingProductionMonths.index'));
        }

        return view('imaging_production_months.show')->with('imagingProductionMonth', $imagingProductionMonth);
    }

    /**
     * Show the form for editing the specified imaging_production_month.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_imagingProductionMonths');
        $imagingProductionMonth = $this->imagingProductionMonthRepository->find($id);

        if (empty($imagingProductionMonth)) {
            Flash::error('Imaging Production Month not found');

            return redirect(route('imagingProductionMonths.index'));
        }

        return view('imaging_production_months.edit')->with('imagingProductionMonth', $imagingProductionMonth);
    }

    /**
     * Update the specified imaging_production_month in storage.
     *
     * @param int $id
     * @param Updateimaging_production_monthRequest $request
     *
     * @return Response
     */
    public function update($id, Updateimaging_production_monthRequest $request)
    {
        $imagingProductionMonth = $this->imagingProductionMonthRepository->find($id);

        if (empty($imagingProductionMonth)) {
            Flash::error('Imaging Production Month not found');

            return redirect(route('imagingProductionMonths.index'));
        }

        $imagingProductionMonth = $this->imagingProductionMonthRepository->update($request->all(), $id);

        Flash::success('Imaging Production Month updated successfully.');

        return redirect(route('imagingProductionMonths.index'));
    }

    /**
     * Remove the specified imaging_production_month from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_imagingProductionMonths');
        $imagingProductionMonth = $this->imagingProductionMonthRepository->find($id);

        if (empty($imagingProductionMonth)) {
            Flash::error('Imaging Production Month not found');

            return redirect(route('imagingProductionMonths.index'));
        }

        $this->imagingProductionMonthRepository->delete($id);

        Flash::success('Imaging Production Month deleted successfully.');

        return redirect(route('imagingProductionMonths.index'));
    }

    public function countImg(){
        $this->authorize('create_imagingProductionMonths');
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
            $monthResults = examen_cita_confirmada::select(
                'examens.modalidad_id',
                'examens.codigo',
                'examens.descripcion',
                DB::raw('COUNT(examens.codigo) AS procedures'), 
                DB::raw("'" . $month . "' Period")
            )
            ->leftjoin('cita_confirmadas', 'cita_confirmadas.id', '=', 'examen_cita_confirmada.cita_confirmada_id')
            ->leftjoin('examens', 'examens.id', '=', 'examen_cita_confirmada.examen_id')
            ->leftjoin('informes', 'informes.examen_id', '=', 'examen_cita_confirmada.id')
            ->whereYear('informes.created_at', $currentYear)
            ->whereMonth('informes.created_at', $month)
            ->whereNotNull('informes.id')
            ->whereNull('informes.deleted_at')
            ->groupBy('examens.modalidad_id', 'examens.codigo', 'examens.descripcion')
            ->orderByDesc('procedures')
            ->get();
            //dd($monthResults);
            $results = array_merge($results, $monthResults->toArray());
        }
        foreach ($results as $result) {
            $observation = "";
            $nameMonth = strtolower(Carbon::createFromDate(null, $result['Period'], null)->format('F'));
            $duration = Imaging_production_details::where('cups', $result['codigo'])->first();
            $procedure = Procedures::where('code', $result['codigo'])->first();
            if (!$procedure) {
                $procedure = Procedures::where('code', '0')->first();
                $observation .= $result['codigo'] . ', ';
            }
            $production = Imaging_production_month::where('cups', $procedure->id)
            ->where('period', (string) $currentYear)
            ->first();
            $modality = modalidads::where('id', $result['modalidad_id'])->first();
            if ($duration) {
                $duration = $duration->duration;
            }else {
                $duration = 0;
            }
            if ($production) {
                $modality = $modality->descripcion;
                if ($production->service == 'ECOCARDIOGRAMA') {
                    $modality = $production->service;
                }
                $production->update([
                    'service' =>$modality,
                    'period' => $currentYear,
                    $nameMonth => $result['procedures'],
                    'duration' => $duration,
                    'cups' => $procedure->id,
                    'observation' => $observation
                ]);
            }else {
                Imaging_production_month::create([
                    'service' => $modality->descripcion,
                    'period' => $currentYear,
                    $nameMonth => $result['procedures'],
                    'duration' => $duration,
                    'cups' => $procedure->id,
                    'observation' => $observation
                ]);
            }
        }
        $this->monthzero();
        $this->calculate();
        return redirect(route('imagingProductionMonths.index'));
    }

    public function calculate(){
        $productions = Imaging_production_month::all();
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

    public function monthzero(){
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
            $nameMonth = $this->monthName($month);
            $monthResults = imaging_production_month::whereNull($nameMonth)
            ->get();
            //dd($monthResults);
            foreach ($monthResults as $monthResult) {
                $monthResult->update([
                    $nameMonth => 0
                ]);
            }
        }
    }

    public function monthName($value)
    {
        switch ($value) {
            case 1:
                return 'january';
                break;
            case 2:
                return 'february';
                break;
            case 3:
                return 'march';
                break;
            case 4:
                return 'april';
                break;
            case 5:
                return 'may';
                break;
            case 6:
                return 'june';
                break;
            case 7:
                return 'july';
                break;
            case 8:
                return 'august';
                break;
            case 9:
                return 'september';
                break;
            case 10:
                return 'october';
                break;
            case 11:
                return 'november';
                break;
            case 12:
                return 'december';
                break;
        }
    }
}
