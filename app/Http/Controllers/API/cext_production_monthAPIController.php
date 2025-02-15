<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createcext_production_monthAPIRequest;
use App\Http\Requests\API\Updatecext_production_monthAPIRequest;
use App\Models\cext_production_month;
use App\Repositories\cext_production_monthRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class cext_production_monthController
 * @package App\Http\Controllers\API
 */

class cext_production_monthAPIController extends AppBaseController
{
    /** @var  cext_production_monthRepository */
    private $cextProductionMonthRepository;

    public function __construct(cext_production_monthRepository $cextProductionMonthRepo)
    {
        $this->cextProductionMonthRepository = $cextProductionMonthRepo;
    }

    /**
     * Display a listing of the cext_production_month.
     * GET|HEAD /cextProductionMonths
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $cextProductionMonths = $this->cextProductionMonthRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cextProductionMonths->toArray(), 'Cext Production Months retrieved successfully');
    }

    /**
     * Store a newly created cext_production_month in storage.
     * POST /cextProductionMonths
     *
     * @param Createcext_production_monthAPIRequest $request
     *
     * @return Response
     */
    public function store(Createcext_production_monthAPIRequest $request)
    {
        $input = $request->all();

        $cextProductionMonth = $this->cextProductionMonthRepository->create($input);

        return $this->sendResponse($cextProductionMonth->toArray(), 'Cext Production Month saved successfully');
    }

    /**
     * Display the specified cext_production_month.
     * GET|HEAD /cextProductionMonths/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var cext_production_month $cextProductionMonth */
        $cextProductionMonth = $this->cextProductionMonthRepository->find($id);

        if (empty($cextProductionMonth)) {
            return $this->sendError('Cext Production Month not found');
        }

        return $this->sendResponse($cextProductionMonth->toArray(), 'Cext Production Month retrieved successfully');
    }

    /**
     * Update the specified cext_production_month in storage.
     * PUT/PATCH /cextProductionMonths/{id}
     *
     * @param int $id
     * @param Updatecext_production_monthAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatecext_production_monthAPIRequest $request)
    {
        $input = $request->all();

        /** @var cext_production_month $cextProductionMonth */
        $cextProductionMonth = $this->cextProductionMonthRepository->find($id);

        if (empty($cextProductionMonth)) {
            return $this->sendError('Cext Production Month not found');
        }

        $cextProductionMonth = $this->cextProductionMonthRepository->update($input, $id);

        return $this->sendResponse($cextProductionMonth->toArray(), 'cext_production_month updated successfully');
    }

    /**
     * Remove the specified cext_production_month from storage.
     * DELETE /cextProductionMonths/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var cext_production_month $cextProductionMonth */
        $cextProductionMonth = $this->cextProductionMonthRepository->find($id);

        if (empty($cextProductionMonth)) {
            return $this->sendError('Cext Production Month not found');
        }

        $cextProductionMonth->delete();

        return $this->sendSuccess('Cext Production Month deleted successfully');
    }
}
