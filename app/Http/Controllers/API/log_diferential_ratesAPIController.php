<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createlog_diferential_ratesAPIRequest;
use App\Http\Requests\API\Updatelog_diferential_ratesAPIRequest;
use App\Models\log_diferential_rates;
use App\Repositories\log_diferential_ratesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class log_diferential_ratesController
 * @package App\Http\Controllers\API
 */

class log_diferential_ratesAPIController extends AppBaseController
{
    /** @var  log_diferential_ratesRepository */
    private $logDiferentialRatesRepository;

    public function __construct(log_diferential_ratesRepository $logDiferentialRatesRepo)
    {
        $this->logDiferentialRatesRepository = $logDiferentialRatesRepo;
    }

    /**
     * Display a listing of the log_diferential_rates.
     * GET|HEAD /logDiferentialRates
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $logDiferentialRates = $this->logDiferentialRatesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($logDiferentialRates->toArray(), 'Log Diferential Rates retrieved successfully');
    }

    /**
     * Store a newly created log_diferential_rates in storage.
     * POST /logDiferentialRates
     *
     * @param Createlog_diferential_ratesAPIRequest $request
     *
     * @return Response
     */
    public function store(Createlog_diferential_ratesAPIRequest $request)
    {
        $input = $request->all();

        $logDiferentialRates = $this->logDiferentialRatesRepository->create($input);

        return $this->sendResponse($logDiferentialRates->toArray(), 'Log Diferential Rates saved successfully');
    }

    /**
     * Display the specified log_diferential_rates.
     * GET|HEAD /logDiferentialRates/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var log_diferential_rates $logDiferentialRates */
        $logDiferentialRates = $this->logDiferentialRatesRepository->find($id);

        if (empty($logDiferentialRates)) {
            return $this->sendError('Log Diferential Rates not found');
        }

        return $this->sendResponse($logDiferentialRates->toArray(), 'Log Diferential Rates retrieved successfully');
    }

    /**
     * Update the specified log_diferential_rates in storage.
     * PUT/PATCH /logDiferentialRates/{id}
     *
     * @param int $id
     * @param Updatelog_diferential_ratesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_diferential_ratesAPIRequest $request)
    {
        $input = $request->all();

        /** @var log_diferential_rates $logDiferentialRates */
        $logDiferentialRates = $this->logDiferentialRatesRepository->find($id);

        if (empty($logDiferentialRates)) {
            return $this->sendError('Log Diferential Rates not found');
        }

        $logDiferentialRates = $this->logDiferentialRatesRepository->update($input, $id);

        return $this->sendResponse($logDiferentialRates->toArray(), 'log_diferential_rates updated successfully');
    }

    /**
     * Remove the specified log_diferential_rates from storage.
     * DELETE /logDiferentialRates/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var log_diferential_rates $logDiferentialRates */
        $logDiferentialRates = $this->logDiferentialRatesRepository->find($id);

        if (empty($logDiferentialRates)) {
            return $this->sendError('Log Diferential Rates not found');
        }

        $logDiferentialRates->delete();

        return $this->sendSuccess('Log Diferential Rates deleted successfully');
    }
}
