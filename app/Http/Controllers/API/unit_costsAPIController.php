<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createunit_costsAPIRequest;
use App\Http\Requests\API\Updateunit_costsAPIRequest;
use App\Models\unit_costs;
use App\Repositories\unit_costsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class unit_costsController
 * @package App\Http\Controllers\API
 */

class unit_costsAPIController extends AppBaseController
{
    /** @var  unit_costsRepository */
    private $unitCostsRepository;

    public function __construct(unit_costsRepository $unitCostsRepo)
    {
        $this->unitCostsRepository = $unitCostsRepo;
    }

    /**
     * Display a listing of the unit_costs.
     * GET|HEAD /unitCosts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $unitCosts = $this->unitCostsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($unitCosts->toArray(), 'Unit Costs retrieved successfully');
    }

    /**
     * Store a newly created unit_costs in storage.
     * POST /unitCosts
     *
     * @param Createunit_costsAPIRequest $request
     *
     * @return Response
     */
    public function store(Createunit_costsAPIRequest $request)
    {
        $input = $request->all();

        $unitCosts = $this->unitCostsRepository->create($input);

        return $this->sendResponse($unitCosts->toArray(), 'Unit Costs saved successfully');
    }

    /**
     * Display the specified unit_costs.
     * GET|HEAD /unitCosts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var unit_costs $unitCosts */
        $unitCosts = $this->unitCostsRepository->find($id);

        if (empty($unitCosts)) {
            return $this->sendError('Unit Costs not found');
        }

        return $this->sendResponse($unitCosts->toArray(), 'Unit Costs retrieved successfully');
    }

    /**
     * Update the specified unit_costs in storage.
     * PUT/PATCH /unitCosts/{id}
     *
     * @param int $id
     * @param Updateunit_costsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateunit_costsAPIRequest $request)
    {
        $input = $request->all();

        /** @var unit_costs $unitCosts */
        $unitCosts = $this->unitCostsRepository->find($id);

        if (empty($unitCosts)) {
            return $this->sendError('Unit Costs not found');
        }

        $unitCosts = $this->unitCostsRepository->update($input, $id);

        return $this->sendResponse($unitCosts->toArray(), 'unit_costs updated successfully');
    }

    /**
     * Remove the specified unit_costs from storage.
     * DELETE /unitCosts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var unit_costs $unitCosts */
        $unitCosts = $this->unitCostsRepository->find($id);

        if (empty($unitCosts)) {
            return $this->sendError('Unit Costs not found');
        }

        $unitCosts->delete();

        return $this->sendSuccess('Unit Costs deleted successfully');
    }
}
