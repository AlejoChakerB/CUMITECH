<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createimaging_productionAPIRequest;
use App\Http\Requests\API\Updateimaging_productionAPIRequest;
use App\Models\imaging_production;
use App\Repositories\imaging_productionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class imaging_productionController
 * @package App\Http\Controllers\API
 */

class imaging_productionAPIController extends AppBaseController
{
    /** @var  imaging_productionRepository */
    private $imagingProductionRepository;

    public function __construct(imaging_productionRepository $imagingProductionRepo)
    {
        $this->imagingProductionRepository = $imagingProductionRepo;
    }

    /**
     * Display a listing of the imaging_production.
     * GET|HEAD /imagingProductions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $imagingProductions = $this->imagingProductionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($imagingProductions->toArray(), 'Imaging Productions retrieved successfully');
    }

    /**
     * Store a newly created imaging_production in storage.
     * POST /imagingProductions
     *
     * @param Createimaging_productionAPIRequest $request
     *
     * @return Response
     */
    public function store(Createimaging_productionAPIRequest $request)
    {
        $input = $request->all();

        $imagingProduction = $this->imagingProductionRepository->create($input);

        return $this->sendResponse($imagingProduction->toArray(), 'Imaging Production saved successfully');
    }

    /**
     * Display the specified imaging_production.
     * GET|HEAD /imagingProductions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var imaging_production $imagingProduction */
        $imagingProduction = $this->imagingProductionRepository->find($id);

        if (empty($imagingProduction)) {
            return $this->sendError('Imaging Production not found');
        }

        return $this->sendResponse($imagingProduction->toArray(), 'Imaging Production retrieved successfully');
    }

    /**
     * Update the specified imaging_production in storage.
     * PUT/PATCH /imagingProductions/{id}
     *
     * @param int $id
     * @param Updateimaging_productionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateimaging_productionAPIRequest $request)
    {
        $input = $request->all();

        /** @var imaging_production $imagingProduction */
        $imagingProduction = $this->imagingProductionRepository->find($id);

        if (empty($imagingProduction)) {
            return $this->sendError('Imaging Production not found');
        }

        $imagingProduction = $this->imagingProductionRepository->update($input, $id);

        return $this->sendResponse($imagingProduction->toArray(), 'imaging_production updated successfully');
    }

    /**
     * Remove the specified imaging_production from storage.
     * DELETE /imagingProductions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var imaging_production $imagingProduction */
        $imagingProduction = $this->imagingProductionRepository->find($id);

        if (empty($imagingProduction)) {
            return $this->sendError('Imaging Production not found');
        }

        $imagingProduction->delete();

        return $this->sendSuccess('Imaging Production deleted successfully');
    }
}
