<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createdetail_packageAPIRequest;
use App\Http\Requests\API\Updatedetail_packageAPIRequest;
use App\Models\detail_package;
use App\Repositories\detail_packageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class detail_packageController
 * @package App\Http\Controllers\API
 */

class detail_packageAPIController extends AppBaseController
{
    /** @var  detail_packageRepository */
    private $detailPackageRepository;

    public function __construct(detail_packageRepository $detailPackageRepo)
    {
        $this->detailPackageRepository = $detailPackageRepo;
    }

    /**
     * Display a listing of the detail_package.
     * GET|HEAD /detailPackages
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $detailPackages = $this->detailPackageRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($detailPackages->toArray(), 'Detail Packages retrieved successfully');
    }

    /**
     * Store a newly created detail_package in storage.
     * POST /detailPackages
     *
     * @param Createdetail_packageAPIRequest $request
     *
     * @return Response
     */
    public function store(Createdetail_packageAPIRequest $request)
    {
        $input = $request->all();

        $detailPackage = $this->detailPackageRepository->create($input);

        return $this->sendResponse($detailPackage->toArray(), 'Detail Package saved successfully');
    }

    /**
     * Display the specified detail_package.
     * GET|HEAD /detailPackages/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var detail_package $detailPackage */
        $detailPackage = $this->detailPackageRepository->find($id);

        if (empty($detailPackage)) {
            return $this->sendError('Detail Package not found');
        }

        return $this->sendResponse($detailPackage->toArray(), 'Detail Package retrieved successfully');
    }

    /**
     * Update the specified detail_package in storage.
     * PUT/PATCH /detailPackages/{id}
     *
     * @param int $id
     * @param Updatedetail_packageAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatedetail_packageAPIRequest $request)
    {
        $input = $request->all();

        /** @var detail_package $detailPackage */
        $detailPackage = $this->detailPackageRepository->find($id);

        if (empty($detailPackage)) {
            return $this->sendError('Detail Package not found');
        }

        $detailPackage = $this->detailPackageRepository->update($input, $id);

        return $this->sendResponse($detailPackage->toArray(), 'detail_package updated successfully');
    }

    /**
     * Remove the specified detail_package from storage.
     * DELETE /detailPackages/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var detail_package $detailPackage */
        $detailPackage = $this->detailPackageRepository->find($id);

        if (empty($detailPackage)) {
            return $this->sendError('Detail Package not found');
        }

        $detailPackage->delete();

        return $this->sendSuccess('Detail Package deleted successfully');
    }
}
