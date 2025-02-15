<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createlog_cext_detailsAPIRequest;
use App\Http\Requests\API\Updatelog_cext_detailsAPIRequest;
use App\Models\log_cext_details;
use App\Repositories\log_cext_detailsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class log_cext_detailsController
 * @package App\Http\Controllers\API
 */

class log_cext_detailsAPIController extends AppBaseController
{
    /** @var  log_cext_detailsRepository */
    private $logCextDetailsRepository;

    public function __construct(log_cext_detailsRepository $logCextDetailsRepo)
    {
        $this->logCextDetailsRepository = $logCextDetailsRepo;
    }

    /**
     * Display a listing of the log_cext_details.
     * GET|HEAD /logCextDetails
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $logCextDetails = $this->logCextDetailsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($logCextDetails->toArray(), 'Log Cext Details retrieved successfully');
    }

    /**
     * Store a newly created log_cext_details in storage.
     * POST /logCextDetails
     *
     * @param Createlog_cext_detailsAPIRequest $request
     *
     * @return Response
     */
    public function store(Createlog_cext_detailsAPIRequest $request)
    {
        $input = $request->all();

        $logCextDetails = $this->logCextDetailsRepository->create($input);

        return $this->sendResponse($logCextDetails->toArray(), 'Log Cext Details saved successfully');
    }

    /**
     * Display the specified log_cext_details.
     * GET|HEAD /logCextDetails/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var log_cext_details $logCextDetails */
        $logCextDetails = $this->logCextDetailsRepository->find($id);

        if (empty($logCextDetails)) {
            return $this->sendError('Log Cext Details not found');
        }

        return $this->sendResponse($logCextDetails->toArray(), 'Log Cext Details retrieved successfully');
    }

    /**
     * Update the specified log_cext_details in storage.
     * PUT/PATCH /logCextDetails/{id}
     *
     * @param int $id
     * @param Updatelog_cext_detailsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_cext_detailsAPIRequest $request)
    {
        $input = $request->all();

        /** @var log_cext_details $logCextDetails */
        $logCextDetails = $this->logCextDetailsRepository->find($id);

        if (empty($logCextDetails)) {
            return $this->sendError('Log Cext Details not found');
        }

        $logCextDetails = $this->logCextDetailsRepository->update($input, $id);

        return $this->sendResponse($logCextDetails->toArray(), 'log_cext_details updated successfully');
    }

    /**
     * Remove the specified log_cext_details from storage.
     * DELETE /logCextDetails/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var log_cext_details $logCextDetails */
        $logCextDetails = $this->logCextDetailsRepository->find($id);

        if (empty($logCextDetails)) {
            return $this->sendError('Log Cext Details not found');
        }

        $logCextDetails->delete();

        return $this->sendSuccess('Log Cext Details deleted successfully');
    }
}
