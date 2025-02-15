<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createlog_cumi_lab_rateAPIRequest;
use App\Http\Requests\API\Updatelog_cumi_lab_rateAPIRequest;
use App\Models\log_cumi_lab_rate;
use App\Repositories\log_cumi_lab_rateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class log_cumi_lab_rateController
 * @package App\Http\Controllers\API
 */

class log_cumi_lab_rateAPIController extends AppBaseController
{
    /** @var  log_cumi_lab_rateRepository */
    private $logCumiLabRateRepository;

    public function __construct(log_cumi_lab_rateRepository $logCumiLabRateRepo)
    {
        $this->logCumiLabRateRepository = $logCumiLabRateRepo;
    }

    /**
     * Display a listing of the log_cumi_lab_rate.
     * GET|HEAD /logCumiLabRates
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $logCumiLabRates = $this->logCumiLabRateRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($logCumiLabRates->toArray(), 'Log Cumi Lab Rates retrieved successfully');
    }

    /**
     * Store a newly created log_cumi_lab_rate in storage.
     * POST /logCumiLabRates
     *
     * @param Createlog_cumi_lab_rateAPIRequest $request
     *
     * @return Response
     */
    public function store(Createlog_cumi_lab_rateAPIRequest $request)
    {
        $input = $request->all();

        $logCumiLabRate = $this->logCumiLabRateRepository->create($input);

        return $this->sendResponse($logCumiLabRate->toArray(), 'Log Cumi Lab Rate saved successfully');
    }

    /**
     * Display the specified log_cumi_lab_rate.
     * GET|HEAD /logCumiLabRates/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var log_cumi_lab_rate $logCumiLabRate */
        $logCumiLabRate = $this->logCumiLabRateRepository->find($id);

        if (empty($logCumiLabRate)) {
            return $this->sendError('Log Cumi Lab Rate not found');
        }

        return $this->sendResponse($logCumiLabRate->toArray(), 'Log Cumi Lab Rate retrieved successfully');
    }

    /**
     * Update the specified log_cumi_lab_rate in storage.
     * PUT/PATCH /logCumiLabRates/{id}
     *
     * @param int $id
     * @param Updatelog_cumi_lab_rateAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_cumi_lab_rateAPIRequest $request)
    {
        $input = $request->all();

        /** @var log_cumi_lab_rate $logCumiLabRate */
        $logCumiLabRate = $this->logCumiLabRateRepository->find($id);

        if (empty($logCumiLabRate)) {
            return $this->sendError('Log Cumi Lab Rate not found');
        }

        $logCumiLabRate = $this->logCumiLabRateRepository->update($input, $id);

        return $this->sendResponse($logCumiLabRate->toArray(), 'log_cumi_lab_rate updated successfully');
    }

    /**
     * Remove the specified log_cumi_lab_rate from storage.
     * DELETE /logCumiLabRates/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var log_cumi_lab_rate $logCumiLabRate */
        $logCumiLabRate = $this->logCumiLabRateRepository->find($id);

        if (empty($logCumiLabRate)) {
            return $this->sendError('Log Cumi Lab Rate not found');
        }

        $logCumiLabRate->delete();

        return $this->sendSuccess('Log Cumi Lab Rate deleted successfully');
    }
}
