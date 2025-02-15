<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createimaging_production_cupsxitemsAPIRequest;
use App\Http\Requests\API\Updateimaging_production_cupsxitemsAPIRequest;
use App\Models\imaging_production_cupsxitems;
use App\Repositories\imaging_production_cupsxitemsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class imaging_production_cupsxitemsController
 * @package App\Http\Controllers\API
 */

class imaging_production_cupsxitemsAPIController extends AppBaseController
{
    /** @var  imaging_production_cupsxitemsRepository */
    private $imagingProductionCupsxitemsRepository;

    public function __construct(imaging_production_cupsxitemsRepository $imagingProductionCupsxitemsRepo)
    {
        $this->imagingProductionCupsxitemsRepository = $imagingProductionCupsxitemsRepo;
    }

    /**
     * Display a listing of the imaging_production_cupsxitems.
     * GET|HEAD /imagingProductionCupsxitems
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $imagingProductionCupsxitems = $this->imagingProductionCupsxitemsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($imagingProductionCupsxitems->toArray(), 'Imaging Production Cupsxitems retrieved successfully');
    }

    /**
     * Store a newly created imaging_production_cupsxitems in storage.
     * POST /imagingProductionCupsxitems
     *
     * @param Createimaging_production_cupsxitemsAPIRequest $request
     *
     * @return Response
     */
    public function store(Createimaging_production_cupsxitemsAPIRequest $request)
    {
        $input = $request->all();

        $imagingProductionCupsxitems = $this->imagingProductionCupsxitemsRepository->create($input);

        return $this->sendResponse($imagingProductionCupsxitems->toArray(), 'Imaging Production Cupsxitems saved successfully');
    }

    /**
     * Display the specified imaging_production_cupsxitems.
     * GET|HEAD /imagingProductionCupsxitems/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var imaging_production_cupsxitems $imagingProductionCupsxitems */
        $imagingProductionCupsxitems = $this->imagingProductionCupsxitemsRepository->find($id);

        if (empty($imagingProductionCupsxitems)) {
            return $this->sendError('Imaging Production Cupsxitems not found');
        }

        return $this->sendResponse($imagingProductionCupsxitems->toArray(), 'Imaging Production Cupsxitems retrieved successfully');
    }

    /**
     * Update the specified imaging_production_cupsxitems in storage.
     * PUT/PATCH /imagingProductionCupsxitems/{id}
     *
     * @param int $id
     * @param Updateimaging_production_cupsxitemsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateimaging_production_cupsxitemsAPIRequest $request)
    {
        $input = $request->all();

        /** @var imaging_production_cupsxitems $imagingProductionCupsxitems */
        $imagingProductionCupsxitems = $this->imagingProductionCupsxitemsRepository->find($id);

        if (empty($imagingProductionCupsxitems)) {
            return $this->sendError('Imaging Production Cupsxitems not found');
        }

        $imagingProductionCupsxitems = $this->imagingProductionCupsxitemsRepository->update($input, $id);

        return $this->sendResponse($imagingProductionCupsxitems->toArray(), 'imaging_production_cupsxitems updated successfully');
    }

    /**
     * Remove the specified imaging_production_cupsxitems from storage.
     * DELETE /imagingProductionCupsxitems/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var imaging_production_cupsxitems $imagingProductionCupsxitems */
        $imagingProductionCupsxitems = $this->imagingProductionCupsxitemsRepository->find($id);

        if (empty($imagingProductionCupsxitems)) {
            return $this->sendError('Imaging Production Cupsxitems not found');
        }

        $imagingProductionCupsxitems->delete();

        return $this->sendSuccess('Imaging Production Cupsxitems deleted successfully');
    }
}
