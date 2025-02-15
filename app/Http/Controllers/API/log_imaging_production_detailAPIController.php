<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createlog_imaging_production_detailAPIRequest;
use App\Http\Requests\API\Updatelog_imaging_production_detailAPIRequest;
use App\Models\log_imaging_production_detail;
use App\Repositories\log_imaging_production_detailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class log_imaging_production_detailController
 * @package App\Http\Controllers\API
 */

class log_imaging_production_detailAPIController extends AppBaseController
{
    /** @var  log_imaging_production_detailRepository */
    private $logImagingProductionDetailRepository;

    public function __construct(log_imaging_production_detailRepository $logImagingProductionDetailRepo)
    {
        $this->logImagingProductionDetailRepository = $logImagingProductionDetailRepo;
    }

    /**
     * Display a listing of the log_imaging_production_detail.
     * GET|HEAD /logImagingProductionDetails
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $logImagingProductionDetails = $this->logImagingProductionDetailRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($logImagingProductionDetails->toArray(), 'Log Imaging Production Details retrieved successfully');
    }

    /**
     * Store a newly created log_imaging_production_detail in storage.
     * POST /logImagingProductionDetails
     *
     * @param Createlog_imaging_production_detailAPIRequest $request
     *
     * @return Response
     */
    public function store(Createlog_imaging_production_detailAPIRequest $request)
    {
        $input = $request->all();

        $logImagingProductionDetail = $this->logImagingProductionDetailRepository->create($input);

        return $this->sendResponse($logImagingProductionDetail->toArray(), 'Log Imaging Production Detail saved successfully');
    }

    /**
     * Display the specified log_imaging_production_detail.
     * GET|HEAD /logImagingProductionDetails/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var log_imaging_production_detail $logImagingProductionDetail */
        $logImagingProductionDetail = $this->logImagingProductionDetailRepository->find($id);

        if (empty($logImagingProductionDetail)) {
            return $this->sendError('Log Imaging Production Detail not found');
        }

        return $this->sendResponse($logImagingProductionDetail->toArray(), 'Log Imaging Production Detail retrieved successfully');
    }

    /**
     * Update the specified log_imaging_production_detail in storage.
     * PUT/PATCH /logImagingProductionDetails/{id}
     *
     * @param int $id
     * @param Updatelog_imaging_production_detailAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_imaging_production_detailAPIRequest $request)
    {
        $input = $request->all();

        /** @var log_imaging_production_detail $logImagingProductionDetail */
        $logImagingProductionDetail = $this->logImagingProductionDetailRepository->find($id);

        if (empty($logImagingProductionDetail)) {
            return $this->sendError('Log Imaging Production Detail not found');
        }

        $logImagingProductionDetail = $this->logImagingProductionDetailRepository->update($input, $id);

        return $this->sendResponse($logImagingProductionDetail->toArray(), 'log_imaging_production_detail updated successfully');
    }

    /**
     * Remove the specified log_imaging_production_detail from storage.
     * DELETE /logImagingProductionDetails/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var log_imaging_production_detail $logImagingProductionDetail */
        $logImagingProductionDetail = $this->logImagingProductionDetailRepository->find($id);

        if (empty($logImagingProductionDetail)) {
            return $this->sendError('Log Imaging Production Detail not found');
        }

        $logImagingProductionDetail->delete();

        return $this->sendSuccess('Log Imaging Production Detail deleted successfully');
    }
}
