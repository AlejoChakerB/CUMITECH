<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createlog_operation_costAPIRequest;
use App\Http\Requests\API\Updatelog_operation_costAPIRequest;
use App\Models\log_operation_cost;
use App\Repositories\log_operation_costRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class log_operation_costController
 * @package App\Http\Controllers\API
 */

class log_operation_costAPIController extends AppBaseController
{
    /** @var  log_operation_costRepository */
    private $logOperationCostRepository;

    public function __construct(log_operation_costRepository $logOperationCostRepo)
    {
        $this->logOperationCostRepository = $logOperationCostRepo;
    }

    /**
     * Display a listing of the log_operation_cost.
     * GET|HEAD /logOperationCosts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $logOperationCosts = $this->logOperationCostRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($logOperationCosts->toArray(), 'Log Operation Costs retrieved successfully');
    }

    /**
     * Store a newly created log_operation_cost in storage.
     * POST /logOperationCosts
     *
     * @param Createlog_operation_costAPIRequest $request
     *
     * @return Response
     */
    public function store(Createlog_operation_costAPIRequest $request)
    {
        $input = $request->all();

        $logOperationCost = $this->logOperationCostRepository->create($input);

        return $this->sendResponse($logOperationCost->toArray(), 'Log Operation Cost saved successfully');
    }

    /**
     * Display the specified log_operation_cost.
     * GET|HEAD /logOperationCosts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var log_operation_cost $logOperationCost */
        $logOperationCost = $this->logOperationCostRepository->find($id);

        if (empty($logOperationCost)) {
            return $this->sendError('Log Operation Cost not found');
        }

        return $this->sendResponse($logOperationCost->toArray(), 'Log Operation Cost retrieved successfully');
    }

    /**
     * Update the specified log_operation_cost in storage.
     * PUT/PATCH /logOperationCosts/{id}
     *
     * @param int $id
     * @param Updatelog_operation_costAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_operation_costAPIRequest $request)
    {
        $input = $request->all();

        /** @var log_operation_cost $logOperationCost */
        $logOperationCost = $this->logOperationCostRepository->find($id);

        if (empty($logOperationCost)) {
            return $this->sendError('Log Operation Cost not found');
        }

        $logOperationCost = $this->logOperationCostRepository->update($input, $id);

        return $this->sendResponse($logOperationCost->toArray(), 'log_operation_cost updated successfully');
    }

    /**
     * Remove the specified log_operation_cost from storage.
     * DELETE /logOperationCosts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var log_operation_cost $logOperationCost */
        $logOperationCost = $this->logOperationCostRepository->find($id);

        if (empty($logOperationCost)) {
            return $this->sendError('Log Operation Cost not found');
        }

        $logOperationCost->delete();

        return $this->sendSuccess('Log Operation Cost deleted successfully');
    }
}
