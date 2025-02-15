<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createlog_patologyAPIRequest;
use App\Http\Requests\API\Updatelog_patologyAPIRequest;
use App\Models\log_patology;
use App\Repositories\log_patologyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class log_patologyController
 * @package App\Http\Controllers\API
 */

class log_patologyAPIController extends AppBaseController
{
    /** @var  log_patologyRepository */
    private $logPatologyRepository;

    public function __construct(log_patologyRepository $logPatologyRepo)
    {
        $this->logPatologyRepository = $logPatologyRepo;
    }

    /**
     * Display a listing of the log_patology.
     * GET|HEAD /logPatologies
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $logPatologies = $this->logPatologyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($logPatologies->toArray(), 'Log Patologies retrieved successfully');
    }

    /**
     * Store a newly created log_patology in storage.
     * POST /logPatologies
     *
     * @param Createlog_patologyAPIRequest $request
     *
     * @return Response
     */
    public function store(Createlog_patologyAPIRequest $request)
    {
        $input = $request->all();

        $logPatology = $this->logPatologyRepository->create($input);

        return $this->sendResponse($logPatology->toArray(), 'Log Patology saved successfully');
    }

    /**
     * Display the specified log_patology.
     * GET|HEAD /logPatologies/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var log_patology $logPatology */
        $logPatology = $this->logPatologyRepository->find($id);

        if (empty($logPatology)) {
            return $this->sendError('Log Patology not found');
        }

        return $this->sendResponse($logPatology->toArray(), 'Log Patology retrieved successfully');
    }

    /**
     * Update the specified log_patology in storage.
     * PUT/PATCH /logPatologies/{id}
     *
     * @param int $id
     * @param Updatelog_patologyAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_patologyAPIRequest $request)
    {
        $input = $request->all();

        /** @var log_patology $logPatology */
        $logPatology = $this->logPatologyRepository->find($id);

        if (empty($logPatology)) {
            return $this->sendError('Log Patology not found');
        }

        $logPatology = $this->logPatologyRepository->update($input, $id);

        return $this->sendResponse($logPatology->toArray(), 'log_patology updated successfully');
    }

    /**
     * Remove the specified log_patology from storage.
     * DELETE /logPatologies/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var log_patology $logPatology */
        $logPatology = $this->logPatologyRepository->find($id);

        if (empty($logPatology)) {
            return $this->sendError('Log Patology not found');
        }

        $logPatology->delete();

        return $this->sendSuccess('Log Patology deleted successfully');
    }
}
