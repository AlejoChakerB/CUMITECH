<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Creatediferential_ratesAPIRequest;
use App\Http\Requests\API\Updatediferential_ratesAPIRequest;
use App\Models\diferential_rates;
use App\Repositories\diferential_ratesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class diferential_ratesController
 * @package App\Http\Controllers\API
 */

class diferential_ratesAPIController extends AppBaseController
{
    /** @var  diferential_ratesRepository */
    private $diferentialRatesRepository;

    public function __construct(diferential_ratesRepository $diferentialRatesRepo)
    {
        $this->diferentialRatesRepository = $diferentialRatesRepo;
    }

    /**
     * Display a listing of the diferential_rates.
     * GET|HEAD /diferentialRates
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $diferentialRates = $this->diferentialRatesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($diferentialRates->toArray(), 'Diferential Rates retrieved successfully');
    }

    /**
     * Store a newly created diferential_rates in storage.
     * POST /diferentialRates
     *
     * @param Creatediferential_ratesAPIRequest $request
     *
     * @return Response
     */
    public function store(Creatediferential_ratesAPIRequest $request)
    {
        $input = $request->all();

        $diferentialRates = $this->diferentialRatesRepository->create($input);

        return $this->sendResponse($diferentialRates->toArray(), 'Diferential Rates saved successfully');
    }

    /**
     * Display the specified diferential_rates.
     * GET|HEAD /diferentialRates/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var diferential_rates $diferentialRates */
        $diferentialRates = $this->diferentialRatesRepository->find($id);

        if (empty($diferentialRates)) {
            return $this->sendError('Diferential Rates not found');
        }

        return $this->sendResponse($diferentialRates->toArray(), 'Diferential Rates retrieved successfully');
    }

    /**
     * Update the specified diferential_rates in storage.
     * PUT/PATCH /diferentialRates/{id}
     *
     * @param int $id
     * @param Updatediferential_ratesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatediferential_ratesAPIRequest $request)
    {
        $input = $request->all();

        /** @var diferential_rates $diferentialRates */
        $diferentialRates = $this->diferentialRatesRepository->find($id);

        if (empty($diferentialRates)) {
            return $this->sendError('Diferential Rates not found');
        }

        $diferentialRates = $this->diferentialRatesRepository->update($input, $id);

        return $this->sendResponse($diferentialRates->toArray(), 'diferential_rates updated successfully');
    }

    /**
     * Remove the specified diferential_rates from storage.
     * DELETE /diferentialRates/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var diferential_rates $diferentialRates */
        $diferentialRates = $this->diferentialRatesRepository->find($id);

        if (empty($diferentialRates)) {
            return $this->sendError('Diferential Rates not found');
        }

        $diferentialRates->delete();

        return $this->sendSuccess('Diferential Rates deleted successfully');
    }
}
