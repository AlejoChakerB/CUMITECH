<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecumiLab_rateAPIRequest;
use App\Http\Requests\API\UpdatecumiLab_rateAPIRequest;
use App\Models\cumiLab_rate;
use App\Repositories\cumiLab_rateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class cumiLab_rateController
 * @package App\Http\Controllers\API
 */

class cumiLab_rateAPIController extends AppBaseController
{
    /** @var  cumiLab_rateRepository */
    private $cumiLabRateRepository;

    public function __construct(cumiLab_rateRepository $cumiLabRateRepo)
    {
        $this->cumiLabRateRepository = $cumiLabRateRepo;
    }

    /**
     * Display a listing of the cumiLab_rate.
     * GET|HEAD /cumiLabRates
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $cumiLabRates = $this->cumiLabRateRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cumiLabRates->toArray(), 'Cumi Lab Rates retrieved successfully');
    }

    /**
     * Store a newly created cumiLab_rate in storage.
     * POST /cumiLabRates
     *
     * @param CreatecumiLab_rateAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecumiLab_rateAPIRequest $request)
    {
        $input = $request->all();

        $cumiLabRate = $this->cumiLabRateRepository->create($input);

        return $this->sendResponse($cumiLabRate->toArray(), 'Cumi Lab Rate saved successfully');
    }

    /**
     * Display the specified cumiLab_rate.
     * GET|HEAD /cumiLabRates/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var cumiLab_rate $cumiLabRate */
        $cumiLabRate = $this->cumiLabRateRepository->find($id);

        if (empty($cumiLabRate)) {
            return $this->sendError('Cumi Lab Rate not found');
        }

        return $this->sendResponse($cumiLabRate->toArray(), 'Cumi Lab Rate retrieved successfully');
    }

    /**
     * Update the specified cumiLab_rate in storage.
     * PUT/PATCH /cumiLabRates/{id}
     *
     * @param int $id
     * @param UpdatecumiLab_rateAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecumiLab_rateAPIRequest $request)
    {
        $input = $request->all();

        /** @var cumiLab_rate $cumiLabRate */
        $cumiLabRate = $this->cumiLabRateRepository->find($id);

        if (empty($cumiLabRate)) {
            return $this->sendError('Cumi Lab Rate not found');
        }

        $cumiLabRate = $this->cumiLabRateRepository->update($input, $id);

        return $this->sendResponse($cumiLabRate->toArray(), 'cumiLab_rate updated successfully');
    }

    /**
     * Remove the specified cumiLab_rate from storage.
     * DELETE /cumiLabRates/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var cumiLab_rate $cumiLabRate */
        $cumiLabRate = $this->cumiLabRateRepository->find($id);

        if (empty($cumiLabRate)) {
            return $this->sendError('Cumi Lab Rate not found');
        }

        $cumiLabRate->delete();

        return $this->sendSuccess('Cumi Lab Rate deleted successfully');
    }
}
