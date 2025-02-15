<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createimaging_production_detailsRequest;
use App\Http\Requests\Updateimaging_production_detailsRequest;
use App\Repositories\imaging_production_detailsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Flash;
use Response;

use App\Models\articles;
use App\Models\imaging_production_hourcost;
use App\Models\imaging_production_details;
use App\Models\imaging_production_supplies;
use App\Models\imaging_production_cupsxitems;
use App\Models\diferential_rates;
use App\Models\procedures;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\imagingdetailImport;
use App\Exports\imagingCost_export\imagingDetailExport;

class imaging_production_detailsController extends AppBaseController
{
    /** @var imaging_production_detailsRepository $imagingProductionDetailsRepository*/
    private $imagingProductionDetailsRepository;

    public function __construct(imaging_production_detailsRepository $imagingProductionDetailsRepo)
    {
        $this->imagingProductionDetailsRepository = $imagingProductionDetailsRepo;
    }

    /**
     * Display a listing of the imaging_production_details.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_imagingProductionDetails');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $imagingProductionDetailsQuery = imaging_production_details::query();

        if (!empty($search)) {
            $imagingProductionDetailsQuery->where('service', 'LIKE', '%' . $search . '%')
            ->orWhere('cups', 'LIKE', '%' . $search . '%')
            ->orWhere('category', 'LIKE', '%' . $search . '%');
        }

        $imagingProductionDetails = $imagingProductionDetailsQuery->paginate($perPage);

        $ecogafry = imaging_production_hourcost::where('service', 'ECOGRAFIA')->value('hour_value_room');
        $ecocar = imaging_production_hourcost::where('service', 'ECOCARDIOGRAMA')->value('hour_value_room');
        $mamo = imaging_production_hourcost::where('service', 'MAMOGRAFIA')->value('hour_value_room');
        $rayx = imaging_production_hourcost::where('service', 'RAYOS X')->value('hour_value_room');
        $reso = imaging_production_hourcost::where('service', 'RESONANCIA')->value('hour_value_room');
        $tomo = imaging_production_hourcost::where('service', 'TOMOGRAFIA')->value('hour_value_room');
        return view('imaging_production_details.index', compact('imagingProductionDetails', 'ecogafry', 'ecocar', 'mamo', 'rayx', 'reso', 'tomo'));
    }

    /**
     * Show the form for creating a new imaging_production_details.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_imagingProductionDetails');
        return view('imaging_production_details.create');
    }

    /**
     * Store a newly created imaging_production_details in storage.
     *
     * @param Createimaging_production_detailsRequest $request
     *
     * @return Response
     */
    public function store(Createimaging_production_detailsRequest $request)
    {
        $input = $request->all();

        $imagingProductionDetails = $this->imagingProductionDetailsRepository->create($input);

        Flash::success('Imaging Production Details saved successfully.');

        return redirect(route('imagingProductionDetails.index'));
    }

    /**
     * Display the specified imaging_production_details.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_imagingProductionDetails');
        $imagingProductionDetails = $this->imagingProductionDetailsRepository->find($id);

        if (empty($imagingProductionDetails)) {
            Flash::error('Imaging Production Details not found');

            return redirect(route('imagingProductionDetails.index'));
        }

        return view('imaging_production_details.show')->with('imagingProductionDetails', $imagingProductionDetails);
    }

    /**
     * Show the form for editing the specified imaging_production_details.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_imagingProductionDetails');
        $imagingProductionDetails = $this->imagingProductionDetailsRepository->find($id);

        if (empty($imagingProductionDetails)) {
            Flash::error('Imaging Production Details not found');

            return redirect(route('imagingProductionDetails.index'));
        }

        return view('imaging_production_details.edit')->with('imagingProductionDetails', $imagingProductionDetails);
    }

    /**
     * Update the specified imaging_production_details in storage.
     *
     * @param int $id
     * @param Updateimaging_production_detailsRequest $request
     *
     * @return Response
     */
    public function update($id, Updateimaging_production_detailsRequest $request)
    {
        $imagingProductionDetails = $this->imagingProductionDetailsRepository->find($id);

        if (empty($imagingProductionDetails)) {
            Flash::error('Imaging Production Details not found');

            return redirect(route('imagingProductionDetails.index'));
        }

        $imagingProductionDetails = $this->imagingProductionDetailsRepository->update($request->all(), $id);

        Flash::success('Imaging Production Details updated successfully.');

        return redirect(route('imagingProductionDetails.index'));
    }

    /**
     * Remove the specified imaging_production_details from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_imagingProductionDetails');
        $imagingProductionDetails = $this->imagingProductionDetailsRepository->find($id);

        if (empty($imagingProductionDetails)) {
            Flash::error('Imaging Production Details not found');

            return redirect(route('imagingProductionDetails.index'));
        }

        $this->imagingProductionDetailsRepository->delete($id);

        Flash::success('Imaging Production Details deleted successfully.');

        return redirect(route('imagingProductionDetails.index'));
    }

    public function calculateImg(){
        $details = Imaging_production_details::all();
        foreach ($details as $detail) {
            $service = imaging_production_hourcost::where('service', $detail->service)->first();
            $durationMin = $detail->duration;
            $room_cost = $detail->duration * ($service->hour_value_room);
            $employee = $durationMin * ($service->employee);
            $doctor_cost = 0;
            $diferential_rates = Diferential_rates::join('procedures', 'diferential_rates.id_procedure', '=', 'procedures.id')
                ->where('procedures.code', $detail->cups)->get();
             
            if ($diferential_rates->isNotEmpty()) {
                $count_df = $diferential_rates->count();
                $value_df = $diferential_rates->sum('value1');
                $doctor_cost = $value_df/$count_df;
            }else {
                $procedure = imaging_production_details::join('procedures', 'procedures.code', '=', 'imaging_production_details.cups')
                ->where('imaging_production_details.cups', $detail->cups)
                ->where('procedures.manual_type', "256")
                ->whereNotNull('procedures.category')
                ->value('procedures.category');
                
                $category = "(IM) " . $procedure;
                $valueDiferentialRate = Diferential_rates::join('procedures', 'diferential_rates.id_procedure', '=', 'procedures.id')
                ->where('procedures.description', $category)
                ->get();
                $doctor_cost = $valueDiferentialRate->max('value1');
            }
            Log::info($detail->category);
            $contrast = imaging_production_supplies::where('service', $detail->category)
            ->where('service', 'LIKE', '%' . 'CONTRASTE' . '%')->first();
            Log::info($contrast);
            $suplies = imaging_production_supplies::where('service', $detail->category)->sum('unit_price'); 
            
            if ($contrast) {
                $contrast = $suplies;
                $suplies = 0;
            }else {
                $contrast = 0;
            }
            $cate = $detail->service . " - SEDACION";
            //dd($cate);
            $sedation = imaging_production_supplies::where('service', $cate)->sum('unit_price');
            if ($sedation > 0) {
                $rate = Diferential_rates::join('procedures', 'diferential_rates.id_procedure', '=', 'procedures.id')
                ->where('procedures.code', '998702')
                ->first();
                $sedation += $rate->value1;

            }
            $total_cost = $room_cost + $employee + $doctor_cost + $suplies + $detail->contrast + $detail->sedation;
            $detail->update([
                'room_cost' => $room_cost,
                'transcriber_cost' => $employee,
                'doctor_cost' => $doctor_cost,
                'supplies_cost' => $suplies,
                'total_cost' => $total_cost,
                'sedation' => $sedation,
                'contrast' => $contrast
            ]);
        }
        return redirect()->back()->with('success', 'Costos calculados correctamente');
    }

    public function importImagingdetail(Request $request)
    {
        $this->authorize('import_imaging');
        $file = $request->file('file');
        try {
            $import = new imagingdetailImport();
            Excel::import($import, $file);

            return redirect()->back()->with('success', '¡Archivo importado correctamente!');
        } catch (\Exception $e) {
            // Manejar el error
            return redirect()->back()->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Importación completada');
    }

    public function downloadDetailImaging()
    {
        $filePath = public_path('Templates/imagenes_detalles.xlsx');
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="imagenes_detalles.xlsx"',
        ];

        return Response::download($filePath, 'Imagenes_detalles.xlsx', $headers);
    }

    public function searchService(Request $request)
    {
        $term = $request->input('term');
        $serviceImage = imaging_production_details::select('service')
        ->where('service', 'like', "%$term%")
        ->groupby('service')
        ->orderby('service')
        ->get();
        
        return response()->json($serviceImage);
    }

    public function searchCategory(Request $request)
    {
        $term = $request->input('term');
        $categoryImage = imaging_production_details::select('category')
        ->where('category', 'like', "%$term%")
        ->groupby('category')
        ->orderby('category')
        ->get();
        
        return response()->json($categoryImage);
    }

    public function exportImaging (Request $request){
        $this->authorize('export_imaging');
        $input = $request->all();
        $fecha = now()->format('Y-m-d H:i:s');
        return Excel::download(new imagingDetailExport($input), 'Costos_imagenes_' . $input['options'] . '_' . $fecha . '.xlsx');
    }
}

