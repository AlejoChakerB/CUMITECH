<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createimaging_production_suppliesAPIRequest;
use App\Http\Requests\API\Updateimaging_production_suppliesAPIRequest;
use App\Models\imaging_production_supplies;
use App\Repositories\imaging_production_suppliesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class imaging_production_suppliesController
 * @package App\Http\Controllers\API
 */

class imaging_production_suppliesAPIController extends AppBaseController
{
    /** @var  imaging_production_suppliesRepository */
    private $imagingProductionSuppliesRepository;

    public function __construct(imaging_production_suppliesRepository $imagingProductionSuppliesRepo)
    {
        $this->imagingProductionSuppliesRepository = $imagingProductionSuppliesRepo;
    }

    /**
     * Display a listing of the imaging_production_supplies.
     * GET|HEAD /imagingProductionSupplies
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $imagingProductionSupplies = $this->imagingProductionSuppliesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($imagingProductionSupplies->toArray(), 'Imaging Production Supplies retrieved successfully');
    }

    /**
     * Store a newly created imaging_production_supplies in storage.
     * POST /imagingProductionSupplies
     *
     * @param Createimaging_production_suppliesAPIRequest $request
     *
     * @return Response
     */
    public function store(Createimaging_production_suppliesAPIRequest $request)
    {
        $input = $request->all();

        $imagingProductionSupplies = $this->imagingProductionSuppliesRepository->create($input);

        return $this->sendResponse($imagingProductionSupplies->toArray(), 'Imaging Production Supplies saved successfully');
    }

    /**
     * Display the specified imaging_production_supplies.
     * GET|HEAD /imagingProductionSupplies/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var imaging_production_supplies $imagingProductionSupplies */
        $imagingProductionSupplies = $this->imagingProductionSuppliesRepository->find($id);

        if (empty($imagingProductionSupplies)) {
            return $this->sendError('Imaging Production Supplies not found');
        }

        return $this->sendResponse($imagingProductionSupplies->toArray(), 'Imaging Production Supplies retrieved successfully');
    }

    /**
     * Update the specified imaging_production_supplies in storage.
     * PUT/PATCH /imagingProductionSupplies/{id}
     *
     * @param int $id
     * @param Updateimaging_production_suppliesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateimaging_production_suppliesAPIRequest $request)
    {
        $input = $request->all();

        /** @var imaging_production_supplies $imagingProductionSupplies */
        $imagingProductionSupplies = $this->imagingProductionSuppliesRepository->find($id);

        if (empty($imagingProductionSupplies)) {
            return $this->sendError('Imaging Production Supplies not found');
        }

        $imagingProductionSupplies = $this->imagingProductionSuppliesRepository->update($input, $id);

        return $this->sendResponse($imagingProductionSupplies->toArray(), 'imaging_production_supplies updated successfully');
    }

    /**
     * Remove the specified imaging_production_supplies from storage.
     * DELETE /imagingProductionSupplies/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var imaging_production_supplies $imagingProductionSupplies */
        $imagingProductionSupplies = $this->imagingProductionSuppliesRepository->find($id);

        if (empty($imagingProductionSupplies)) {
            return $this->sendError('Imaging Production Supplies not found');
        }

        $imagingProductionSupplies->delete();

        return $this->sendSuccess('Imaging Production Supplies deleted successfully');
    }
}
