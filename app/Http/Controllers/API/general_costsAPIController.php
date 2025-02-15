<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Creategeneral_costsAPIRequest;
use App\Http\Requests\API\Updategeneral_costsAPIRequest;
use App\Models\general_costs;
use App\Repositories\general_costsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class general_costsController
 * @package App\Http\Controllers\API
 */

class general_costsAPIController extends AppBaseController
{
    /** @var  general_costsRepository */
    private $generalCostsRepository;

    public function __construct(general_costsRepository $generalCostsRepo)
    {
        $this->generalCostsRepository = $generalCostsRepo;
    }

    /**
     * Display a listing of the general_costs.
     * GET|HEAD /generalCosts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $generalCosts = $this->generalCostsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($generalCosts->toArray(), 'General Costs retrieved successfully');
    }

    /**
     * Store a newly created general_costs in storage.
     * POST /generalCosts
     *
     * @param Creategeneral_costsAPIRequest $request
     *
     * @return Response
     */
    public function store(Creategeneral_costsAPIRequest $request)
    {
        $input = $request->all();

        $generalCosts = $this->generalCostsRepository->create($input);

        return $this->sendResponse($generalCosts->toArray(), 'General Costs saved successfully');
    }

    /**
     * Display the specified general_costs.
     * GET|HEAD /generalCosts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var general_costs $generalCosts */
        $generalCosts = $this->generalCostsRepository->find($id);

        if (empty($generalCosts)) {
            return $this->sendError('General Costs not found');
        }

        return $this->sendResponse($generalCosts->toArray(), 'General Costs retrieved successfully');
    }

    /**
     * Update the specified general_costs in storage.
     * PUT/PATCH /generalCosts/{id}
     *
     * @param int $id
     * @param Updategeneral_costsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updategeneral_costsAPIRequest $request)
    {
        $input = $request->all();

        /** @var general_costs $generalCosts */
        $generalCosts = $this->generalCostsRepository->find($id);

        if (empty($generalCosts)) {
            return $this->sendError('General Costs not found');
        }

        $generalCosts = $this->generalCostsRepository->update($input, $id);

        return $this->sendResponse($generalCosts->toArray(), 'general_costs updated successfully');
    }

    /**
     * Remove the specified general_costs from storage.
     * DELETE /generalCosts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var general_costs $generalCosts */
        $generalCosts = $this->generalCostsRepository->find($id);

        if (empty($generalCosts)) {
            return $this->sendError('General Costs not found');
        }

        $generalCosts->delete();

        return $this->sendSuccess('General Costs deleted successfully');
    }
}
