<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createimaging_production_monthAPIRequest;
use App\Http\Requests\API\Updateimaging_production_monthAPIRequest;
use App\Models\imaging_production_month;
use App\Repositories\imaging_production_monthRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class imaging_production_monthController
 * @package App\Http\Controllers\API
 */

class imaging_production_monthAPIController extends AppBaseController
{
    /** @var  imaging_production_monthRepository */
    private $imagingProductionMonthRepository;

    public function __construct(imaging_production_monthRepository $imagingProductionMonthRepo)
    {
        $this->imagingProductionMonthRepository = $imagingProductionMonthRepo;
    }

    /**
     * Display a listing of the imaging_production_month.
     * GET|HEAD /imagingProductionMonths
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $imagingProductionMonths = $this->imagingProductionMonthRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($imagingProductionMonths->toArray(), 'Imaging Production Months retrieved successfully');
    }

    /**
     * Store a newly created imaging_production_month in storage.
     * POST /imagingProductionMonths
     *
     * @param Createimaging_production_monthAPIRequest $request
     *
     * @return Response
     */
    public function store(Createimaging_production_monthAPIRequest $request)
    {
        $input = $request->all();

        $imagingProductionMonth = $this->imagingProductionMonthRepository->create($input);

        return $this->sendResponse($imagingProductionMonth->toArray(), 'Imaging Production Month saved successfully');
    }

    /**
     * Display the specified imaging_production_month.
     * GET|HEAD /imagingProductionMonths/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var imaging_production_month $imagingProductionMonth */
        $imagingProductionMonth = $this->imagingProductionMonthRepository->find($id);

        if (empty($imagingProductionMonth)) {
            return $this->sendError('Imaging Production Month not found');
        }

        return $this->sendResponse($imagingProductionMonth->toArray(), 'Imaging Production Month retrieved successfully');
    }

    /**
     * Update the specified imaging_production_month in storage.
     * PUT/PATCH /imagingProductionMonths/{id}
     *
     * @param int $id
     * @param Updateimaging_production_monthAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateimaging_production_monthAPIRequest $request)
    {
        $input = $request->all();

        /** @var imaging_production_month $imagingProductionMonth */
        $imagingProductionMonth = $this->imagingProductionMonthRepository->find($id);

        if (empty($imagingProductionMonth)) {
            return $this->sendError('Imaging Production Month not found');
        }

        $imagingProductionMonth = $this->imagingProductionMonthRepository->update($input, $id);

        return $this->sendResponse($imagingProductionMonth->toArray(), 'imaging_production_month updated successfully');
    }

    /**
     * Remove the specified imaging_production_month from storage.
     * DELETE /imagingProductionMonths/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var imaging_production_month $imagingProductionMonth */
        $imagingProductionMonth = $this->imagingProductionMonthRepository->find($id);

        if (empty($imagingProductionMonth)) {
            return $this->sendError('Imaging Production Month not found');
        }

        $imagingProductionMonth->delete();

        return $this->sendSuccess('Imaging Production Month deleted successfully');
    }
}
