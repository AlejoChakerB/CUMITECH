<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createlog_accommodation_costAPIRequest;
use App\Http\Requests\API\Updatelog_accommodation_costAPIRequest;
use App\Models\log_accommodation_cost;
use App\Repositories\log_accommodation_costRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class log_accommodation_costController
 * @package App\Http\Controllers\API
 */

class log_accommodation_costAPIController extends AppBaseController
{
    /** @var  log_accommodation_costRepository */
    private $logAccommodationCostRepository;

    public function __construct(log_accommodation_costRepository $logAccommodationCostRepo)
    {
        $this->logAccommodationCostRepository = $logAccommodationCostRepo;
    }

    /**
     * Display a listing of the log_accommodation_cost.
     * GET|HEAD /logAccommodationCosts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $logAccommodationCosts = $this->logAccommodationCostRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($logAccommodationCosts->toArray(), 'Log Accommodation Costs retrieved successfully');
    }

    /**
     * Store a newly created log_accommodation_cost in storage.
     * POST /logAccommodationCosts
     *
     * @param Createlog_accommodation_costAPIRequest $request
     *
     * @return Response
     */
    public function store(Createlog_accommodation_costAPIRequest $request)
    {
        $input = $request->all();

        $logAccommodationCost = $this->logAccommodationCostRepository->create($input);

        return $this->sendResponse($logAccommodationCost->toArray(), 'Log Accommodation Cost saved successfully');
    }

    /**
     * Display the specified log_accommodation_cost.
     * GET|HEAD /logAccommodationCosts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var log_accommodation_cost $logAccommodationCost */
        $logAccommodationCost = $this->logAccommodationCostRepository->find($id);

        if (empty($logAccommodationCost)) {
            return $this->sendError('Log Accommodation Cost not found');
        }

        return $this->sendResponse($logAccommodationCost->toArray(), 'Log Accommodation Cost retrieved successfully');
    }

    /**
     * Update the specified log_accommodation_cost in storage.
     * PUT/PATCH /logAccommodationCosts/{id}
     *
     * @param int $id
     * @param Updatelog_accommodation_costAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_accommodation_costAPIRequest $request)
    {
        $input = $request->all();

        /** @var log_accommodation_cost $logAccommodationCost */
        $logAccommodationCost = $this->logAccommodationCostRepository->find($id);

        if (empty($logAccommodationCost)) {
            return $this->sendError('Log Accommodation Cost not found');
        }

        $logAccommodationCost = $this->logAccommodationCostRepository->update($input, $id);

        return $this->sendResponse($logAccommodationCost->toArray(), 'log_accommodation_cost updated successfully');
    }

    /**
     * Remove the specified log_accommodation_cost from storage.
     * DELETE /logAccommodationCosts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var log_accommodation_cost $logAccommodationCost */
        $logAccommodationCost = $this->logAccommodationCostRepository->find($id);

        if (empty($logAccommodationCost)) {
            return $this->sendError('Log Accommodation Cost not found');
        }

        $logAccommodationCost->delete();

        return $this->sendSuccess('Log Accommodation Cost deleted successfully');
    }
}
