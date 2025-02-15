<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createlog_operation_costRequest;
use App\Http\Requests\Updatelog_operation_costRequest;
use App\Repositories\log_operation_costRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Flash;
use Response;

use App\Models\log_operation_cost;
use App\Models\procedures;
use App\Models\Surgery;

class log_operation_costController extends AppBaseController
{
    /** @var log_operation_costRepository $logOperationCostRepository*/
    private $logOperationCostRepository;

    public function __construct(log_operation_costRepository $logOperationCostRepo)
    {
        $this->logOperationCostRepository = $logOperationCostRepo;
    }

    /**
     * Display a listing of the log_operation_cost.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_logoperationcosts');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $logOperationCostsQuery = log_operation_cost::query();

        if (!empty($search)) {
            $logOperationCostsQuery->where('cod_surgical_act', 'LIKE', '%' . $search . '%')
                    ->orWhere('id_fact', 'LIKE', '%' . $search . '%')
                    ->orWhere('cod_package', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('procedures', function ($query) use ($search) {
                        $query->where('code', 'LIKE', '%' . $search . '%')
                        ->orWhere('cups', 'LIKE', '%' . $search . '%');
                    });
        }

        $logOperationCosts = $logOperationCostsQuery->paginate($perPage);

        return view('log_operation_costs.index')
            ->with('logOperationCosts', $logOperationCosts);
    }

    /**
     * Show the form for creating a new log_operation_cost.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_logoperationcosts');
        $surgical_acts = Surgery::orderby('cod_surgical_act')->pluck('cod_surgical_act');
        $procedures = procedures::orderby('code')->pluck('code', 'id');
        return view('log_operation_costs.create', compact('procedures', 'surgical_acts'));
    }

    /**
     * Store a newly created log_operation_cost in storage.
     *
     * @param Createlog_operation_costRequest $request
     *
     * @return Response
     */
    public function store(Createlog_operation_costRequest $request)
    {
        $input = $request->all();

        $total = $request->input('room_cost') + $request->input('gas') +  $request->input('labour') +  $request->input('basket') +  $request->input('medical_fees') + $request->input('medical_fees2') + $request->input('anesthesiologist_fees') + $request->input('consumables');
        $input['total_value'] = $total;
        $input['mode'] = 'manual';

        $logOperationCost = $this->logOperationCostRepository->create($input);

        Flash::success('Log Operation Cost saved successfully.');

        return redirect(route('logOperationCosts.index'));
    }

    /**
     * Display the specified log_operation_cost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_logoperationcosts');
        $logOperationCost = $this->logOperationCostRepository->find($id);

        if (empty($logOperationCost)) {
            Flash::error('Log Operation Cost not found');

            return redirect(route('logOperationCosts.index'));
        }

        return view('log_operation_costs.show')->with('logOperationCost', $logOperationCost);
    }

    /**
     * Show the form for editing the specified log_operation_cost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_logoperationcosts');
        $logOperationCost = $this->logOperationCostRepository->find($id);

        if (empty($logOperationCost)) {
            Flash::error('Log Operation Cost not found');

            return redirect(route('logOperationCosts.index'));
        }
        $surgical_acts = Surgery::orderby('cod_surgical_act')->pluck('cod_surgical_act', 'cod_surgical_act');
        $procedures = procedures::orderby('code')->pluck('code', 'id');
        return view('log_operation_costs.edit', compact('logOperationCost', 'surgical_acts', 'procedures'));
    }

    /**
     * Update the specified log_operation_cost in storage.
     *
     * @param int $id
     * @param Updatelog_operation_costRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_operation_costRequest $request)
    {
        $logOperationCost = $this->logOperationCostRepository->find($id);

        if (empty($logOperationCost)) {
            Flash::error('Log Operation Cost not found');

            return redirect(route('logOperationCosts.index'));
        }

        $logOperationCost = $this->logOperationCostRepository->update($request->all(), $id);

        Flash::success('Log Operation Cost updated successfully.');

        return redirect((route('logOperationCosts.index')));
    }

    /**
     * Remove the specified log_operation_cost from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_logoperationcosts');
        $logOperationCost = $this->logOperationCostRepository->find($id);

        if (empty($logOperationCost)) {
            Flash::error('Log Operation Cost not found');

            return redirect(route('logOperationCosts.index'));
        }

        $this->logOperationCostRepository->delete($id);

        Flash::success('Log Operation Cost deleted successfully.');

        return redirect(route('logOperationCosts.index'));
    }

    public function searchCupsSurgery(Request $request)
    {
        $term = $request->input('term');
        $code = log_operation_cost::join('procedures', 'procedures.id', '=', 'log_operation_costs.code_procedure')
        ->where('procedures.code', 'like', "%$term%")
        ->select('procedures.code', DB::raw('MAX(procedures.description) AS description'))
        ->groupby('procedures.code')
        ->orderby('description')
        ->get();
        return response()->json($code);
    }
}
