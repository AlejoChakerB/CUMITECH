<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createdist_packageAPIRequest;
use App\Http\Requests\API\Updatedist_packageAPIRequest;
use App\Models\dist_package;
use App\Repositories\dist_packageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class dist_packageController
 * @package App\Http\Controllers\API
 */

class dist_packageAPIController extends AppBaseController
{
    /** @var  dist_packageRepository */
    private $distPackageRepository;

    public function __construct(dist_packageRepository $distPackageRepo)
    {
        $this->distPackageRepository = $distPackageRepo;
    }

    /**
     * Display a listing of the dist_package.
     * GET|HEAD /distPackages
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $distPackages = $this->distPackageRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($distPackages->toArray(), 'Dist Packages retrieved successfully');
    }

    /**
     * Store a newly created dist_package in storage.
     * POST /distPackages
     *
     * @param Createdist_packageAPIRequest $request
     *
     * @return Response
     */
    public function store(Createdist_packageAPIRequest $request)
    {
        $input = $request->all();

        $distPackage = $this->distPackageRepository->create($input);

        return $this->sendResponse($distPackage->toArray(), 'Dist Package saved successfully');
    }

    /**
     * Display the specified dist_package.
     * GET|HEAD /distPackages/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var dist_package $distPackage */
        $distPackage = $this->distPackageRepository->find($id);

        if (empty($distPackage)) {
            return $this->sendError('Dist Package not found');
        }

        return $this->sendResponse($distPackage->toArray(), 'Dist Package retrieved successfully');
    }

    /**
     * Update the specified dist_package in storage.
     * PUT/PATCH /distPackages/{id}
     *
     * @param int $id
     * @param Updatedist_packageAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatedist_packageAPIRequest $request)
    {
        $input = $request->all();

        /** @var dist_package $distPackage */
        $distPackage = $this->distPackageRepository->find($id);

        if (empty($distPackage)) {
            return $this->sendError('Dist Package not found');
        }

        $distPackage = $this->distPackageRepository->update($input, $id);

        return $this->sendResponse($distPackage->toArray(), 'dist_package updated successfully');
    }

    /**
     * Remove the specified dist_package from storage.
     * DELETE /distPackages/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var dist_package $distPackage */
        $distPackage = $this->distPackageRepository->find($id);

        if (empty($distPackage)) {
            return $this->sendError('Dist Package not found');
        }

        $distPackage->delete();

        return $this->sendSuccess('Dist Package deleted successfully');
    }
}
