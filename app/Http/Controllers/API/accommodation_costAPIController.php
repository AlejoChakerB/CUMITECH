<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createaccommodation_costAPIRequest;
use App\Http\Requests\API\Updateaccommodation_costAPIRequest;
use App\Models\accommodation_cost;
use App\Repositories\accommodation_costRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class accommodation_costController
 * @package App\Http\Controllers\API
 */

class accommodation_costAPIController extends AppBaseController
{
    /** @var  accommodation_costRepository */
    private $accommodationCostRepository;

    public function __construct(accommodation_costRepository $accommodationCostRepo)
    {
        $this->accommodationCostRepository = $accommodationCostRepo;
    }

    /**
     * Display a listing of the accommodation_cost.
     * GET|HEAD /accommodationCosts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $accommodationCosts = $this->accommodationCostRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($accommodationCosts->toArray(), 'Accommodation Costs retrieved successfully');
    }

    /**
     * Store a newly created accommodation_cost in storage.
     * POST /accommodationCosts
     *
     * @param Createaccommodation_costAPIRequest $request
     *
     * @return Response
     */
    public function store(Createaccommodation_costAPIRequest $request)
    {
        $input = $request->all();

        $accommodationCost = $this->accommodationCostRepository->create($input);

        return $this->sendResponse($accommodationCost->toArray(), 'Accommodation Cost saved successfully');
    }

    /**
     * Display the specified accommodation_cost.
     * GET|HEAD /accommodationCosts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var accommodation_cost $accommodationCost */
        $accommodationCost = $this->accommodationCostRepository->find($id);

        if (empty($accommodationCost)) {
            return $this->sendError('Accommodation Cost not found');
        }

        return $this->sendResponse($accommodationCost->toArray(), 'Accommodation Cost retrieved successfully');
    }

    /**
     * Update the specified accommodation_cost in storage.
     * PUT/PATCH /accommodationCosts/{id}
     *
     * @param int $id
     * @param Updateaccommodation_costAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateaccommodation_costAPIRequest $request)
    {
        $input = $request->all();

        /** @var accommodation_cost $accommodationCost */
        $accommodationCost = $this->accommodationCostRepository->find($id);

        if (empty($accommodationCost)) {
            return $this->sendError('Accommodation Cost not found');
        }

        $accommodationCost = $this->accommodationCostRepository->update($input, $id);

        return $this->sendResponse($accommodationCost->toArray(), 'accommodation_cost updated successfully');
    }

    /**
     * Remove the specified accommodation_cost from storage.
     * DELETE /accommodationCosts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var accommodation_cost $accommodationCost */
        $accommodationCost = $this->accommodationCostRepository->find($id);

        if (empty($accommodationCost)) {
            return $this->sendError('Accommodation Cost not found');
        }

        $accommodationCost->delete();

        return $this->sendSuccess('Accommodation Cost deleted successfully');
    }
}
