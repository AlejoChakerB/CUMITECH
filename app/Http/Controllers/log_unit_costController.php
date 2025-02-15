<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createlog_unit_costRequest;
use App\Http\Requests\Updatelog_unit_costRequest;
use App\Repositories\log_unit_costRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class log_unit_costController extends AppBaseController
{
    /** @var log_unit_costRepository $logUnitCostRepository*/
    private $logUnitCostRepository;

    public function __construct(log_unit_costRepository $logUnitCostRepo)
    {
        $this->logUnitCostRepository = $logUnitCostRepo;
    }

    /**
     * Display a listing of the log_unit_cost.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $logUnitCosts = $this->logUnitCostRepository->all();

        return view('log_unit_costs.index')
            ->with('logUnitCosts', $logUnitCosts);
    }

    /**
     * Show the form for creating a new log_unit_cost.
     *
     * @return Response
     */
    public function create()
    {
        return view('log_unit_costs.create');
    }

    /**
     * Store a newly created log_unit_cost in storage.
     *
     * @param Createlog_unit_costRequest $request
     *
     * @return Response
     */
    public function store(Createlog_unit_costRequest $request)
    {
        $input = $request->all();

        $logUnitCost = $this->logUnitCostRepository->create($input);

        Flash::success('Log Unit Cost saved successfully.');

        return redirect(route('logUnitCosts.index'));
    }

    /**
     * Display the specified log_unit_cost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $logUnitCost = $this->logUnitCostRepository->find($id);

        if (empty($logUnitCost)) {
            Flash::error('Log Unit Cost not found');

            return redirect(route('logUnitCosts.index'));
        }

        return view('log_unit_costs.show')->with('logUnitCost', $logUnitCost);
    }

    /**
     * Show the form for editing the specified log_unit_cost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $logUnitCost = $this->logUnitCostRepository->find($id);

        if (empty($logUnitCost)) {
            Flash::error('Log Unit Cost not found');

            return redirect(route('logUnitCosts.index'));
        }

        return view('log_unit_costs.edit')->with('logUnitCost', $logUnitCost);
    }

    /**
     * Update the specified log_unit_cost in storage.
     *
     * @param int $id
     * @param Updatelog_unit_costRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_unit_costRequest $request)
    {
        $logUnitCost = $this->logUnitCostRepository->find($id);

        if (empty($logUnitCost)) {
            Flash::error('Log Unit Cost not found');

            return redirect(route('logUnitCosts.index'));
        }

        $logUnitCost = $this->logUnitCostRepository->update($request->all(), $id);

        Flash::success('Log Unit Cost updated successfully.');

        return redirect(route('logUnitCosts.index'));
    }

    /**
     * Remove the specified log_unit_cost from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $logUnitCost = $this->logUnitCostRepository->find($id);

        if (empty($logUnitCost)) {
            Flash::error('Log Unit Cost not found');

            return redirect(route('logUnitCosts.index'));
        }

        $this->logUnitCostRepository->delete($id);

        Flash::success('Log Unit Cost deleted successfully.');

        return redirect(route('logUnitCosts.index'));
    }
}
