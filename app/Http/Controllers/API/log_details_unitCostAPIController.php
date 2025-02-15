<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createlog_details_unitCostAPIRequest;
use App\Http\Requests\API\Updatelog_details_unitCostAPIRequest;
use App\Models\log_details_unitCost;
use App\Repositories\log_details_unitCostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class log_details_unitCostController
 * @package App\Http\Controllers\API
 */

class log_details_unitCostAPIController extends AppBaseController
{
    /** @var  log_details_unitCostRepository */
    private $logDetailsUnitCostRepository;

    public function __construct(log_details_unitCostRepository $logDetailsUnitCostRepo)
    {
        $this->logDetailsUnitCostRepository = $logDetailsUnitCostRepo;
    }

    /**
     * Display a listing of the log_details_unitCost.
     * GET|HEAD /logDetailsUnitCosts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $logDetailsUnitCosts = $this->logDetailsUnitCostRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($logDetailsUnitCosts->toArray(), 'Log Details Unit Costs retrieved successfully');
    }

    /**
     * Store a newly created log_details_unitCost in storage.
     * POST /logDetailsUnitCosts
     *
     * @param Createlog_details_unitCostAPIRequest $request
     *
     * @return Response
     */
    public function store(Createlog_details_unitCostAPIRequest $request)
    {
        $input = $request->all();

        $logDetailsUnitCost = $this->logDetailsUnitCostRepository->create($input);

        return $this->sendResponse($logDetailsUnitCost->toArray(), 'Log Details Unit Cost saved successfully');
    }

    /**
     * Display the specified log_details_unitCost.
     * GET|HEAD /logDetailsUnitCosts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var log_details_unitCost $logDetailsUnitCost */
        $logDetailsUnitCost = $this->logDetailsUnitCostRepository->find($id);

        if (empty($logDetailsUnitCost)) {
            return $this->sendError('Log Details Unit Cost not found');
        }

        return $this->sendResponse($logDetailsUnitCost->toArray(), 'Log Details Unit Cost retrieved successfully');
    }

    /**
     * Update the specified log_details_unitCost in storage.
     * PUT/PATCH /logDetailsUnitCosts/{id}
     *
     * @param int $id
     * @param Updatelog_details_unitCostAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_details_unitCostAPIRequest $request)
    {
        $input = $request->all();

        /** @var log_details_unitCost $logDetailsUnitCost */
        $logDetailsUnitCost = $this->logDetailsUnitCostRepository->find($id);

        if (empty($logDetailsUnitCost)) {
            return $this->sendError('Log Details Unit Cost not found');
        }

        $logDetailsUnitCost = $this->logDetailsUnitCostRepository->update($input, $id);

        return $this->sendResponse($logDetailsUnitCost->toArray(), 'log_details_unitCost updated successfully');
    }

    /**
     * Remove the specified log_details_unitCost from storage.
     * DELETE /logDetailsUnitCosts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var log_details_unitCost $logDetailsUnitCost */
        $logDetailsUnitCost = $this->logDetailsUnitCostRepository->find($id);

        if (empty($logDetailsUnitCost)) {
            return $this->sendError('Log Details Unit Cost not found');
        }

        $logDetailsUnitCost->delete();

        return $this->sendSuccess('Log Details Unit Cost deleted successfully');
    }
}
