<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createdetail_packages_tempAPIRequest;
use App\Http\Requests\API\Updatedetail_packages_tempAPIRequest;
use App\Models\detail_packages_temp;
use App\Repositories\detail_packages_tempRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class detail_packages_tempController
 * @package App\Http\Controllers\API
 */

class detail_packages_tempAPIController extends AppBaseController
{
    /** @var  detail_packages_tempRepository */
    private $detailPackagesTempRepository;

    public function __construct(detail_packages_tempRepository $detailPackagesTempRepo)
    {
        $this->detailPackagesTempRepository = $detailPackagesTempRepo;
    }

    /**
     * Display a listing of the detail_packages_temp.
     * GET|HEAD /detailPackagesTemps
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $detailPackagesTemps = $this->detailPackagesTempRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($detailPackagesTemps->toArray(), 'Detail Packages Temps retrieved successfully');
    }

    /**
     * Store a newly created detail_packages_temp in storage.
     * POST /detailPackagesTemps
     *
     * @param Createdetail_packages_tempAPIRequest $request
     *
     * @return Response
     */
    public function store(Createdetail_packages_tempAPIRequest $request)
    {
        $input = $request->all();

        $detailPackagesTemp = $this->detailPackagesTempRepository->create($input);

        return $this->sendResponse($detailPackagesTemp->toArray(), 'Detail Packages Temp saved successfully');
    }

    /**
     * Display the specified detail_packages_temp.
     * GET|HEAD /detailPackagesTemps/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var detail_packages_temp $detailPackagesTemp */
        $detailPackagesTemp = $this->detailPackagesTempRepository->find($id);

        if (empty($detailPackagesTemp)) {
            return $this->sendError('Detail Packages Temp not found');
        }

        return $this->sendResponse($detailPackagesTemp->toArray(), 'Detail Packages Temp retrieved successfully');
    }

    /**
     * Update the specified detail_packages_temp in storage.
     * PUT/PATCH /detailPackagesTemps/{id}
     *
     * @param int $id
     * @param Updatedetail_packages_tempAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatedetail_packages_tempAPIRequest $request)
    {
        $input = $request->all();

        /** @var detail_packages_temp $detailPackagesTemp */
        $detailPackagesTemp = $this->detailPackagesTempRepository->find($id);

        if (empty($detailPackagesTemp)) {
            return $this->sendError('Detail Packages Temp not found');
        }

        $detailPackagesTemp = $this->detailPackagesTempRepository->update($input, $id);

        return $this->sendResponse($detailPackagesTemp->toArray(), 'detail_packages_temp updated successfully');
    }

    /**
     * Remove the specified detail_packages_temp from storage.
     * DELETE /detailPackagesTemps/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var detail_packages_temp $detailPackagesTemp */
        $detailPackagesTemp = $this->detailPackagesTempRepository->find($id);

        if (empty($detailPackagesTemp)) {
            return $this->sendError('Detail Packages Temp not found');
        }

        $detailPackagesTemp->delete();

        return $this->sendSuccess('Detail Packages Temp deleted successfully');
    }
}
