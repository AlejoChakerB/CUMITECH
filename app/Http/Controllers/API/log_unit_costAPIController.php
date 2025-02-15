<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createlog_unit_costAPIRequest;
use App\Http\Requests\API\Updatelog_unit_costAPIRequest;
use App\Models\log_unit_cost;
use App\Repositories\log_unit_costRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class log_unit_costController
 * @package App\Http\Controllers\API
 */

class log_unit_costAPIController extends AppBaseController
{
    /** @var  log_unit_costRepository */
    private $logUnitCostRepository;

    public function __construct(log_unit_costRepository $logUnitCostRepo)
    {
        $this->logUnitCostRepository = $logUnitCostRepo;
    }

    /**
     * Display a listing of the log_unit_cost.
     * GET|HEAD /logUnitCosts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $logUnitCosts = $this->logUnitCostRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($logUnitCosts->toArray(), 'Log Unit Costs retrieved successfully');
    }

    /**
     * Store a newly created log_unit_cost in storage.
     * POST /logUnitCosts
     *
     * @param Createlog_unit_costAPIRequest $request
     *
     * @return Response
     */
    public function store(Createlog_unit_costAPIRequest $request)
    {
        $input = $request->all();

        $logUnitCost = $this->logUnitCostRepository->create($input);

        return $this->sendResponse($logUnitCost->toArray(), 'Log Unit Cost saved successfully');
    }

    /**
     * Display the specified log_unit_cost.
     * GET|HEAD /logUnitCosts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var log_unit_cost $logUnitCost */
        $logUnitCost = $this->logUnitCostRepository->find($id);

        if (empty($logUnitCost)) {
            return $this->sendError('Log Unit Cost not found');
        }

        return $this->sendResponse($logUnitCost->toArray(), 'Log Unit Cost retrieved successfully');
    }

    /**
     * Update the specified log_unit_cost in storage.
     * PUT/PATCH /logUnitCosts/{id}
     *
     * @param int $id
     * @param Updatelog_unit_costAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_unit_costAPIRequest $request)
    {
        $input = $request->all();

        /** @var log_unit_cost $logUnitCost */
        $logUnitCost = $this->logUnitCostRepository->find($id);

        if (empty($logUnitCost)) {
            return $this->sendError('Log Unit Cost not found');
        }

        $logUnitCost = $this->logUnitCostRepository->update($input, $id);

        return $this->sendResponse($logUnitCost->toArray(), 'log_unit_cost updated successfully');
    }

    /**
     * Remove the specified log_unit_cost from storage.
     * DELETE /logUnitCosts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var log_unit_cost $logUnitCost */
        $logUnitCost = $this->logUnitCostRepository->find($id);

        if (empty($logUnitCost)) {
            return $this->sendError('Log Unit Cost not found');
        }

        $logUnitCost->delete();

        return $this->sendSuccess('Log Unit Cost deleted successfully');
    }
}
