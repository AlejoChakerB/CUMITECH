<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createlog_ambulance_costAPIRequest;
use App\Http\Requests\API\Updatelog_ambulance_costAPIRequest;
use App\Models\log_ambulance_cost;
use App\Repositories\log_ambulance_costRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class log_ambulance_costController
 * @package App\Http\Controllers\API
 */

class log_ambulance_costAPIController extends AppBaseController
{
    /** @var  log_ambulance_costRepository */
    private $logAmbulanceCostRepository;

    public function __construct(log_ambulance_costRepository $logAmbulanceCostRepo)
    {
        $this->logAmbulanceCostRepository = $logAmbulanceCostRepo;
    }

    /**
     * Display a listing of the log_ambulance_cost.
     * GET|HEAD /logAmbulanceCosts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $logAmbulanceCosts = $this->logAmbulanceCostRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($logAmbulanceCosts->toArray(), 'Log Ambulance Costs retrieved successfully');
    }

    /**
     * Store a newly created log_ambulance_cost in storage.
     * POST /logAmbulanceCosts
     *
     * @param Createlog_ambulance_costAPIRequest $request
     *
     * @return Response
     */
    public function store(Createlog_ambulance_costAPIRequest $request)
    {
        $input = $request->all();

        $logAmbulanceCost = $this->logAmbulanceCostRepository->create($input);

        return $this->sendResponse($logAmbulanceCost->toArray(), 'Log Ambulance Cost saved successfully');
    }

    /**
     * Display the specified log_ambulance_cost.
     * GET|HEAD /logAmbulanceCosts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var log_ambulance_cost $logAmbulanceCost */
        $logAmbulanceCost = $this->logAmbulanceCostRepository->find($id);

        if (empty($logAmbulanceCost)) {
            return $this->sendError('Log Ambulance Cost not found');
        }

        return $this->sendResponse($logAmbulanceCost->toArray(), 'Log Ambulance Cost retrieved successfully');
    }

    /**
     * Update the specified log_ambulance_cost in storage.
     * PUT/PATCH /logAmbulanceCosts/{id}
     *
     * @param int $id
     * @param Updatelog_ambulance_costAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_ambulance_costAPIRequest $request)
    {
        $input = $request->all();

        /** @var log_ambulance_cost $logAmbulanceCost */
        $logAmbulanceCost = $this->logAmbulanceCostRepository->find($id);

        if (empty($logAmbulanceCost)) {
            return $this->sendError('Log Ambulance Cost not found');
        }

        $logAmbulanceCost = $this->logAmbulanceCostRepository->update($input, $id);

        return $this->sendResponse($logAmbulanceCost->toArray(), 'log_ambulance_cost updated successfully');
    }

    /**
     * Remove the specified log_ambulance_cost from storage.
     * DELETE /logAmbulanceCosts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var log_ambulance_cost $logAmbulanceCost */
        $logAmbulanceCost = $this->logAmbulanceCostRepository->find($id);

        if (empty($logAmbulanceCost)) {
            return $this->sendError('Log Ambulance Cost not found');
        }

        $logAmbulanceCost->delete();

        return $this->sendSuccess('Log Ambulance Cost deleted successfully');
    }
}
