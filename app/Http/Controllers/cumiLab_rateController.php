<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecumiLab_rateRequest;
use App\Http\Requests\UpdatecumiLab_rateRequest;
use App\Repositories\cumiLab_rateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Flash;
use Response;

use App\Models\CumiLab_rate;
use App\Models\general_costs;
use App\Models\procedures;
use App\Models\cumi_lab_historic;

use Maatwebsite\Excel\Facades\Excel;

use App\Imports\CumilabImport;
use App\Exports\CumiLab\CumiLab_export;

class cumiLab_rateController extends AppBaseController
{
    /** @var cumiLab_rateRepository $cumiLabRateRepository*/
    private $cumiLabRateRepository;

    public function __construct(cumiLab_rateRepository $cumiLabRateRepo)
    {
        $this->cumiLabRateRepository = $cumiLabRateRepo;
    }

    /**
     * Display a listing of the cumiLab_rate.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_cumiLabRates');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $cumiLabRatesQuery = CumiLab_rate::query();

        if (!empty($search)) {
            $cumiLabRatesQuery->where('cups', 'LIKE', '%' . $search . '%')
            ->orWhere('observation', 'LIKE', '%' . $search . '%');
        }

        $cumiLabRates = $cumiLabRatesQuery->paginate($perPage);
        $first = CumiLab_rate::select('period')->first();
        $yearOnly = '';
        if ($first) {
            $yearOnly = date('Y', strtotime($first->period));
        }
        $cd = CumiLab_rate::sum('cd_percentage');
        $adminlog = CumiLab_rate::sum('adminlog_percentage');
        return view('cumi_lab_rates.index', compact('cumiLabRates', 'yearOnly', 'cd', 'adminlog'));
    }

    /**
     * Show the form for creating a new cumiLab_rate.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_cumiLabRates');
        return view('cumi_lab_rates.create');
    }

    /**
     * Store a newly created cumiLab_rate in storage.
     *
     * @param CreatecumiLab_rateRequest $request
     *
     * @return Response
     */
    public function store(CreatecumiLab_rateRequest $request)
    {
        $input = $request->all();

        $cumiLabRate = $this->cumiLabRateRepository->create($input);

        session()->flash('success', "¡¡Costo CumiLab añadido correctamente!!");

        return redirect(route('cumiLabRates.index'));
    }

    /**
     * Display the specified cumiLab_rate.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_cumiLabRates');
        $rate = $this->cumiLabRateRepository->find($id);

        if (empty($rate)) {
            Flash::error('Cumi Lab Rate not found');

            return redirect(route('cumiLabRates.index'));
        }

        return $rate;
    }

    /**
     * Show the form for editing the specified cumiLab_rate.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_cumiLabRates');
        $cumiLabRate = $this->cumiLabRateRepository->find($id);

        $procedure = Procedures::where('code', $cumiLabRate->cups)->first();
        $proc = collect([$procedure])->map(function ($procedure) {
            return [
                $procedure->id => $procedure->description . ' (CUPS: ' . $procedure->cups . " - " . $procedure->manual_type . ')'
            ];
        })->first();
        if (empty($cumiLabRate)) {
            Flash::error('Cumi Lab Rate not found');

            return redirect(route('cumiLabRates.index'));
        }

        return view('cumi_lab_rates.edit', compact('cumiLabRate', 'proc'));
    }

    /**
     * Update the specified cumiLab_rate in storage.
     *
     * @param int $id
     * @param UpdatecumiLab_rateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecumiLab_rateRequest $request)
    {
        $cumiLabRate = $this->cumiLabRateRepository->find($id);
        $input = $request->all();
        $procedure =  Procedures::where('code', $input['cups'])->first();
        $input['cups'] = $procedure->code;
        if (empty($cumiLabRate)) {
            Flash::error('Cumi Lab Rate not found');

            return redirect(route('cumiLabRates.index'));
        }

        $cumiLabRate = $this->cumiLabRateRepository->update($input, $id);

        session()->flash('success', "¡¡Costo CumiLab actualizado correctamente!!");

        return redirect(route('cumiLabRates.index'));
    }

    /**
     * Remove the specified cumiLab_rate from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_cumiLabRates');
        $cumiLabRate = $this->cumiLabRateRepository->find($id);
        if (empty($cumiLabRate)) {
            Flash::error('Cumi Lab Rate not found');

            return redirect(route('cumiLabRates.index'));
        }

        $this->cumiLabRateRepository->delete($id);

        session()->flash('success', "¡¡Costo CumiLab eliminado correctamente!!");

        return redirect(route('cumiLabRates.index'));
    }

    public function importlab(Request $request)
    {
        $this->authorize('import_cumiLabRates');
        $file = $request->file('file');
        try {
            $import = new CumilabImport();
            Excel::import($import, $file);

            return redirect()->back()->with('success', '¡Archivo importado correctamente!');
        } catch (\Exception $e) {
            // Manejar el error
            return redirect()->back()->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Importación completada');
    }

    public function calculateLab()
    {
        $this->authorize('create_cumiLabRates');
        $rates = cumiLab_rate::all();
        foreach ($rates as $rate) {
            $meses = array_filter([
                'january' => $rate->january,
                'february' => $rate->february,
                'march' => $rate->march,
                'april' => $rate->april,
                'may' => $rate->may,
                'june' => $rate->june,
                'july' => $rate->july,
                'august' => $rate->august,
                'september' => $rate->september,
                'october' => $rate->october,
                'november' => $rate->november,
                'december' => $rate->december,
            ], function ($value) {
                return !is_null($value) && $value !== '';
            }, ARRAY_FILTER_USE_BOTH);
        
            // Contar los meses no nulos
            $quanty_month = count($meses);
            $total_month = array_sum($meses);
            $average_month = $total_month/$quanty_month;
            $pq = $average_month*$rate->mutual_rate;
            $rate->update([
                'total_months' => $total_month,
                'average_months' => $average_month,
                'pxq' => $pq
            ]);        
        }
        $this->calculateLabTotal();
        return redirect()->back()->with('success', 'Importación completada');
    }

    public function calculateLabTotal(){
        $rates = CumiLab_rate::all();
        $total_sum = CumiLab_rate::sum('pxq');
        $adminLog = General_costs::where('code', 11)->first();
        $cd = General_costs::where('code', 12)->first();
        foreach ($rates as $rate) {
            $partic = $rate->pxq/$total_sum;
            $adminlog_percentage = ($partic * $adminLog->value)/$rate->average_months;
            $cd_percentage = ($partic * $cd->value)/$rate->average_months;
            $dist = ($adminlog_percentage + $cd_percentage);
            $total = $rate->cumilab_rate + $dist;
            $rate->update([
                'part_percentage' => $partic*100,
                'adminlog_percentage' => $adminlog_percentage,
                'cd_percentage' => $cd_percentage,
                'total' => $total
            ]);
        }
    }

    public function endPeriod(){
        $this->authorize('end_cumiLabRates');
        $CumiLabRates = CumiLab_rate::all();
        $adminLog = general_costs::where('code', 11)->first();
        $cd = general_costs::where('code', 12)->first();
        foreach ($CumiLabRates as $rate) {
            // Verifica cada columna correspondiente a los meses
            if ($rate->january === null || $rate->february === null || $rate->march === null || $rate->april === null || $rate->may === null || $rate->june === null || $rate->july === null || $rate->august === null || $rate->september === null || $rate->october === null || $rate->november === null || $rate->december === null) {
                return redirect()->back()->with('error', 'El siguiente CUPS debe registrar todos los meses para finalizar periodo: ' . $rate->cups);
            }elseif ($rate->cups == '0') {
                return redirect()->back()->with('error', 'Faltan CUPS sin homologar - CUPS: ' . $rate->cups . ' Observacion: ' . $rate->observation);
            }
        }

        foreach ($CumiLabRates as $cumiLab) {
            $existing = cumi_lab_historic::where('cups', $cumiLab->cups)
            ->Where('period', $cumiLab->period)
            ->first();

            if ($existing) {
                $validation = $existing->update([
                    'period' => $cumiLab->period,
                    'january' => $cumiLab->january,
                    'february' => $cumiLab->february,
                    'march' => $cumiLab->march,
                    'april' => $cumiLab->april,
                    'may' => $cumiLab->may,
                    'june' => $cumiLab->june,
                    'july' => $cumiLab->july,
                    'august' => $cumiLab->august,
                    'september' => $cumiLab->september,
                    'october' => $cumiLab->october,
                    'november' => $cumiLab->november,
                    'december' => $cumiLab->december,
                    'total_months' => $cumiLab->total_months,
                    'average_months' => $cumiLab->average_months,
                    'cumilab_rate' => $cumiLab->cumilab_rate,
                    'mutual_rate' => $cumiLab->mutual_rate,
                    'pxq' => $cumiLab->pxq,
                    'part_percentage' => $cumiLab->part_percentage,
                    'adminlog' => $adminLog->value,
                    'adminlog_percentage' => $cumiLab->adminlog_percentage,
                    'cd' => $cd->value,
                    'cd_percentage' => $cumiLab->cd_percentage,
                    'total' => $cumiLab->total,
                    'cups' => $cumiLab->cups
                ]);
                if ($validation == true) {
                    $this->cumiLabRateRepository->delete($cumiLab->id);
                }
            }else {
                $validation = Cumi_lab_historic::create([
                    'period' => $cumiLab->period,
                    'january' => $cumiLab->january,
                    'february' => $cumiLab->february,
                    'march' => $cumiLab->march,
                    'april' => $cumiLab->april,
                    'may' => $cumiLab->may,
                    'june' => $cumiLab->june,
                    'july' => $cumiLab->july,
                    'august' => $cumiLab->august,
                    'september' => $cumiLab->september,
                    'october' => $cumiLab->october,
                    'november' => $cumiLab->november,
                    'december' => $cumiLab->december,
                    'total_months' => $cumiLab->total_months,
                    'average_months' => $cumiLab->average_months,
                    'cumilab_rate' => $cumiLab->cumilab_rate,
                    'mutual_rate' => $cumiLab->mutual_rate,
                    'pxq' => $cumiLab->pxq,
                    'part_percentage' => $cumiLab->part_percentage,
                    'adminlog' => $adminLog->value,
                    'adminlog_percentage' => $cumiLab->adminlog_percentage,
                    'cd' => $cd->value,
                    'cd_percentage' => $cumiLab->cd_percentage,
                    'total' => $cumiLab->total,
                    'cups' => $cumiLab->cups
                ]);
                if ($validation == true) {
                    $this->cumiLabRateRepository->delete($cumiLab->id);
                }
            }
        }
        session()->flash('success', "¡¡Periodo finalizado correctamente!!");
        return redirect(route('cumiLabHistorics.index'));
    }

    public function exportCumiLab(){
        $this->authorize('export_cumiLabRates');
        $fecha = now()->format('Y-m-d H:i:s');
        return Excel::download(new CumiLab_export(), 'Costos_cumiLab_' . $fecha . '.xlsx');
    }
}
