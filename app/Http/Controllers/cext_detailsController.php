<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createcext_detailsRequest;
use App\Http\Requests\Updatecext_detailsRequest;
use App\Repositories\cext_detailsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\cextCost_export\cextDetailExport;

use App\Models\cext_details;
use App\Models\cext_hourcost;
use App\Models\cext_production_month;
use App\Models\diferential_rates;
use App\Models\procedures;

class cext_detailsController extends AppBaseController
{
    /** @var cext_detailsRepository $cextDetailsRepository*/
    private $cextDetailsRepository;

    public function __construct(cext_detailsRepository $cextDetailsRepo)
    {
        $this->cextDetailsRepository = $cextDetailsRepo;
    }

    /**
     * Display a listing of the cext_details.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_cextDetails');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $cextDetailsQuery = cext_details::query();

        if (!empty($search)) {
            $cextDetailsQuery->where('specialty', 'LIKE', '%' . $search . '%')
                            ->orWhere('procedure', 'LIKE', '%' . $search . '%');
        }

        $cextDetails = $cextDetailsQuery->paginate($perPage);
        $hourCost = cext_hourcost::first();
        if (!$hourCost) {
            $hourCost = (object) ['room_value' => 0, 'number_room' => 0, 'days_produced' => 0];
        }
        return view('cext_details.index', compact('cextDetails', 'hourCost'));
    }

    /**
     * Show the form for creating a new cext_details.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_cextDetails');
        $procedures = Procedures::orderby('code')->pluck('description', 'code');
        return view('cext_details.create', compact('procedures'));
    }

    /**
     * Store a newly created cext_details in storage.
     *
     * @param Createcext_detailsRequest $request
     *
     * @return Response
     */
    public function store(Createcext_detailsRequest $request)
    {
        $input = $request->all();

        $cextDetails = $this->cextDetailsRepository->create($input);

        session()->flash('success', "¡¡Costos de la especialidad " . $input['specialty'] . " añadido correctamente!!");

        return redirect(route('cextDetails.index'));
    }

    /**
     * Display the specified cext_details.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_cextDetails');
        $cextDetails = $this->cextDetailsRepository->find($id);

        if (empty($cextDetails)) {
            Flash::error('Cext Details not found');

            return redirect(route('cextDetails.index'));
        }

        return view('cext_details.show')->with('cextDetails', $cextDetails);
    }

    /**
     * Show the form for editing the specified cext_details.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_cextDetails');
        $cextDetails = $this->cextDetailsRepository->find($id);

        if (empty($cextDetails)) {
            Flash::error('Cext Details not found');

            return redirect(route('cextDetails.index'));
        }
        $procedures = Procedures::orderby('code')->pluck('description', 'code');
        return view('cext_details.edit', compact('cextDetails', 'procedures'));
    }

    /**
     * Update the specified cext_details in storage.
     *
     * @param int $id
     * @param Updatecext_detailsRequest $request
     *
     * @return Response
     */
    public function update($id, Updatecext_detailsRequest $request)
    {
        $cextDetails = $this->cextDetailsRepository->find($id);
        $input = $request->all();

        if (empty($cextDetails)) {
            Flash::error('Cext Details not found');

            return redirect(route('cextDetails.index'));
        }

        $cextDetails = $this->cextDetailsRepository->update($input, $id);

        session()->flash('success', "¡¡Costos de la especialidad " . $input['specialty'] . " actualizado correctamente!!");

        return redirect(route('cextDetails.index'));
    }

    /**
     * Remove the specified cext_details from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_cextDetails');
        $cextDetails = $this->cextDetailsRepository->find($id);

        if (empty($cextDetails)) {
            Flash::error('Cext Details not found');

            return redirect(route('cextDetails.index'));
        }

        $this->cextDetailsRepository->delete($id);

        session()->flash('success', "¡¡Costos de la especialidad " . $cextDetails->specialty . " eliminado correctamente!!");

        return redirect(route('cextDetails.index'));
    }

    public function calculate(){
        $this->authorize('create_cextDetails');
        $details = cext_details::all();
        foreach ($details as $detail) {
            $room = cext_hourcost::first();
            $durationMin = ($detail->duration/60);
            $room_cost = $durationMin * ($room->room_valueTotal);
            $suplies = 0;
            $diferentialRates = Diferential_rates::join('doctors', 'diferential_rates.id_doctor', '=', 'doctors.code')
                ->join('procedures', 'diferential_rates.id_procedure', '=', 'procedures.id')
                ->select('diferential_rates.*')
                ->where('procedures.code', $detail->procedure)
                ->where('doctors.specialty', $detail->specialty)
                ->get();
            $quanty = $diferentialRates->count();
            $sum = $diferentialRates->sum('value1');
            $medical_fees = 0;
            if ($quanty != 0) {
                $medical_fees = $sum/$quanty;
            }
            $total_cost = $room_cost + $medical_fees +$suplies;
            $detail->update([
                'room_cost' => $room_cost,
                'medical_fees' => $medical_fees,
                'supplies_cost' => $suplies,
                'total_cost' => $total_cost
            ]);
        }
        session()->flash('success', "¡¡Costos de consulta externa actualizados correctamente!!");
        return redirect(route('cextDetails.index'));
    }

    public function searchCextSpecialty(Request $request)
    {
        $term = $request->input('term');
        $doctors = cext_production_month::where('specialty', 'like', "%$term%")->get();
        
        return response()->json($doctors);
    }

    public function exportCext (Request $request){
        $this->authorize('exporti_cextDetails');
        $input = $request->all();
        $fecha = now()->format('Y-m-d H:i:s');
        return Excel::download(new cextDetailExport($input), 'Costos_cext_' . $input['options'] . '_' . $fecha . '.xlsx');
    }
}
