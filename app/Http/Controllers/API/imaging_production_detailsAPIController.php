<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createimaging_production_detailsAPIRequest;
use App\Http\Requests\API\Updateimaging_production_detailsAPIRequest;
use App\Models\imaging_production_details;
use App\Repositories\imaging_production_detailsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class imaging_production_detailsController
 * @package App\Http\Controllers\API
 */

class imaging_production_detailsAPIController extends AppBaseController
{
    /** @var  imaging_production_detailsRepository */
    private $imagingProductionDetailsRepository;

    public function __construct(imaging_production_detailsRepository $imagingProductionDetailsRepo)
    {
        $this->imagingProductionDetailsRepository = $imagingProductionDetailsRepo;
    }

    /**
     * Display a listing of the imaging_production_details.
     * GET|HEAD /imagingProductionDetails
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $imagingProductionDetails = $this->imagingProductionDetailsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($imagingProductionDetails->toArray(), 'Imaging Production Details retrieved successfully');
    }

    /**
     * Store a newly created imaging_production_details in storage.
     * POST /imagingProductionDetails
     *
     * @param Createimaging_production_detailsAPIRequest $request
     *
     * @return Response
     */
    public function store(Createimaging_production_detailsAPIRequest $request)
    {
        $input = $request->all();

        $imagingProductionDetails = $this->imagingProductionDetailsRepository->create($input);

        return $this->sendResponse($imagingProductionDetails->toArray(), 'Imaging Production Details saved successfully');
    }

    /**
     * Display the specified imaging_production_details.
     * GET|HEAD /imagingProductionDetails/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var imaging_production_details $imagingProductionDetails */
        $imagingProductionDetails = $this->imagingProductionDetailsRepository->find($id);

        if (empty($imagingProductionDetails)) {
            return $this->sendError('Imaging Production Details not found');
        }

        return $this->sendResponse($imagingProductionDetails->toArray(), 'Imaging Production Details retrieved successfully');
    }

    /**
     * Update the specified imaging_production_details in storage.
     * PUT/PATCH /imagingProductionDetails/{id}
     *
     * @param int $id
     * @param Updateimaging_production_detailsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateimaging_production_detailsAPIRequest $request)
    {
        $input = $request->all();

        /** @var imaging_production_details $imagingProductionDetails */
        $imagingProductionDetails = $this->imagingProductionDetailsRepository->find($id);

        if (empty($imagingProductionDetails)) {
            return $this->sendError('Imaging Production Details not found');
        }

        $imagingProductionDetails = $this->imagingProductionDetailsRepository->update($input, $id);

        return $this->sendResponse($imagingProductionDetails->toArray(), 'imaging_production_details updated successfully');
    }

    /**
     * Remove the specified imaging_production_details from storage.
     * DELETE /imagingProductionDetails/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var imaging_production_details $imagingProductionDetails */
        $imagingProductionDetails = $this->imagingProductionDetailsRepository->find($id);

        if (empty($imagingProductionDetails)) {
            return $this->sendError('Imaging Production Details not found');
        }

        $imagingProductionDetails->delete();

        return $this->sendSuccess('Imaging Production Details deleted successfully');
    }
}
