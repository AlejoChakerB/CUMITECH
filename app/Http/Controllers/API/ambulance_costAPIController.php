<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createambulance_costAPIRequest;
use App\Http\Requests\API\Updateambulance_costAPIRequest;
use App\Models\ambulance_cost;
use App\Repositories\ambulance_costRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ambulance_costController
 * @package App\Http\Controllers\API
 */

class ambulance_costAPIController extends AppBaseController
{
    /** @var  ambulance_costRepository */
    private $ambulanceCostRepository;

    public function __construct(ambulance_costRepository $ambulanceCostRepo)
    {
        $this->ambulanceCostRepository = $ambulanceCostRepo;
    }

    /**
     * Display a listing of the ambulance_cost.
     * GET|HEAD /ambulanceCosts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $ambulanceCosts = $this->ambulanceCostRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($ambulanceCosts->toArray(), 'Ambulance Costs retrieved successfully');
    }

    /**
     * Store a newly created ambulance_cost in storage.
     * POST /ambulanceCosts
     *
     * @param Createambulance_costAPIRequest $request
     *
     * @return Response
     */
    public function store(Createambulance_costAPIRequest $request)
    {
        $input = $request->all();

        $ambulanceCost = $this->ambulanceCostRepository->create($input);

        return $this->sendResponse($ambulanceCost->toArray(), 'Ambulance Cost saved successfully');
    }

    /**
     * Display the specified ambulance_cost.
     * GET|HEAD /ambulanceCosts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ambulance_cost $ambulanceCost */
        $ambulanceCost = $this->ambulanceCostRepository->find($id);

        if (empty($ambulanceCost)) {
            return $this->sendError('Ambulance Cost not found');
        }

        return $this->sendResponse($ambulanceCost->toArray(), 'Ambulance Cost retrieved successfully');
    }

    /**
     * Update the specified ambulance_cost in storage.
     * PUT/PATCH /ambulanceCosts/{id}
     *
     * @param int $id
     * @param Updateambulance_costAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateambulance_costAPIRequest $request)
    {
        $input = $request->all();

        /** @var ambulance_cost $ambulanceCost */
        $ambulanceCost = $this->ambulanceCostRepository->find($id);

        if (empty($ambulanceCost)) {
            return $this->sendError('Ambulance Cost not found');
        }

        $ambulanceCost = $this->ambulanceCostRepository->update($input, $id);

        return $this->sendResponse($ambulanceCost->toArray(), 'ambulance_cost updated successfully');
    }

    /**
     * Remove the specified ambulance_cost from storage.
     * DELETE /ambulanceCosts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ambulance_cost $ambulanceCost */
        $ambulanceCost = $this->ambulanceCostRepository->find($id);

        if (empty($ambulanceCost)) {
            return $this->sendError('Ambulance Cost not found');
        }

        $ambulanceCost->delete();

        return $this->sendSuccess('Ambulance Cost deleted successfully');
    }
}
