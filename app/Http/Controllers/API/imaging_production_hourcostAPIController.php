<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createimaging_production_hourcostAPIRequest;
use App\Http\Requests\API\Updateimaging_production_hourcostAPIRequest;
use App\Models\imaging_production_hourcost;
use App\Repositories\imaging_production_hourcostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class imaging_production_hourcostController
 * @package App\Http\Controllers\API
 */

class imaging_production_hourcostAPIController extends AppBaseController
{
    /** @var  imaging_production_hourcostRepository */
    private $imagingProductionHourcostRepository;

    public function __construct(imaging_production_hourcostRepository $imagingProductionHourcostRepo)
    {
        $this->imagingProductionHourcostRepository = $imagingProductionHourcostRepo;
    }

    /**
     * Display a listing of the imaging_production_hourcost.
     * GET|HEAD /imagingProductionHourcosts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $imagingProductionHourcosts = $this->imagingProductionHourcostRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($imagingProductionHourcosts->toArray(), 'Imaging Production Hourcosts retrieved successfully');
    }

    /**
     * Store a newly created imaging_production_hourcost in storage.
     * POST /imagingProductionHourcosts
     *
     * @param Createimaging_production_hourcostAPIRequest $request
     *
     * @return Response
     */
    public function store(Createimaging_production_hourcostAPIRequest $request)
    {
        $input = $request->all();

        $imagingProductionHourcost = $this->imagingProductionHourcostRepository->create($input);

        return $this->sendResponse($imagingProductionHourcost->toArray(), 'Imaging Production Hourcost saved successfully');
    }

    /**
     * Display the specified imaging_production_hourcost.
     * GET|HEAD /imagingProductionHourcosts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var imaging_production_hourcost $imagingProductionHourcost */
        $imagingProductionHourcost = $this->imagingProductionHourcostRepository->find($id);

        if (empty($imagingProductionHourcost)) {
            return $this->sendError('Imaging Production Hourcost not found');
        }

        return $this->sendResponse($imagingProductionHourcost->toArray(), 'Imaging Production Hourcost retrieved successfully');
    }

    /**
     * Update the specified imaging_production_hourcost in storage.
     * PUT/PATCH /imagingProductionHourcosts/{id}
     *
     * @param int $id
     * @param Updateimaging_production_hourcostAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateimaging_production_hourcostAPIRequest $request)
    {
        $input = $request->all();

        /** @var imaging_production_hourcost $imagingProductionHourcost */
        $imagingProductionHourcost = $this->imagingProductionHourcostRepository->find($id);

        if (empty($imagingProductionHourcost)) {
            return $this->sendError('Imaging Production Hourcost not found');
        }

        $imagingProductionHourcost = $this->imagingProductionHourcostRepository->update($input, $id);

        return $this->sendResponse($imagingProductionHourcost->toArray(), 'imaging_production_hourcost updated successfully');
    }

    /**
     * Remove the specified imaging_production_hourcost from storage.
     * DELETE /imagingProductionHourcosts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var imaging_production_hourcost $imagingProductionHourcost */
        $imagingProductionHourcost = $this->imagingProductionHourcostRepository->find($id);

        if (empty($imagingProductionHourcost)) {
            return $this->sendError('Imaging Production Hourcost not found');
        }

        $imagingProductionHourcost->delete();

        return $this->sendSuccess('Imaging Production Hourcost deleted successfully');
    }
}
