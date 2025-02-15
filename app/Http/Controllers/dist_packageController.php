<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createdist_packageRequest;
use App\Http\Requests\Updatedist_packageRequest;
use App\Repositories\dist_packageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\dist_package;

class dist_packageController extends AppBaseController
{
    /** @var dist_packageRepository $distPackageRepository*/
    private $distPackageRepository;

    public function __construct(dist_packageRepository $distPackageRepo)
    {
        $this->distPackageRepository = $distPackageRepo;
    }

    /**
     * Display a listing of the dist_package.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_distPackages');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $distPackagesQuery = dist_package::query();

        if (!empty($search)) {
            $distPackagesQuery->where('id_factu', 'LIKE', '%' . $search . '%')
            ->orWhere('study', 'LIKE', '%' . $search . '%')
            ->orWhere('cod_surgical_act', 'LIKE', '%' . $search . '%');
        }

        $distPackages = $distPackagesQuery->orderBy('id', 'DESC')->paginate($perPage);

        return view('dist_packages.index', compact('distPackages'));
    }

    /**
     * Show the form for creating a new dist_package.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_distPackages');
        return view('dist_packages.create');
    }

    /**
     * Store a newly created dist_package in storage.
     *
     * @param Createdist_packageRequest $request
     *
     * @return Response
     */
    public function store(Createdist_packageRequest $request)
    {
        $input = $request->all();

        $distPackage = $this->distPackageRepository->create($input);

        Flash::success('Dist Package saved successfully.');

        return redirect(route('distPackages.index'));
    }

    /**
     * Display the specified dist_package.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_distPackages');
        $distPackage = $this->distPackageRepository->find($id);

        if (empty($distPackage)) {
            Flash::error('Dist Package not found');

            return redirect(route('distPackages.index'));
        }

        return view('dist_packages.show')->with('distPackage', $distPackage);
    }

    /**
     * Show the form for editing the specified dist_package.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_distPackages');
        $distPackage = $this->distPackageRepository->find($id);

        if (empty($distPackage)) {
            Flash::error('Dist Package not found');

            return redirect(route('distPackages.index'));
        }

        return view('dist_packages.edit')->with('distPackage', $distPackage);
    }

    /**
     * Update the specified dist_package in storage.
     *
     * @param int $id
     * @param Updatedist_packageRequest $request
     *
     * @return Response
     */
    public function update($id, Updatedist_packageRequest $request)
    {
        $distPackage = $this->distPackageRepository->find($id);

        if (empty($distPackage)) {
            Flash::error('Dist Package not found');

            return redirect(route('distPackages.index'));
        }

        $distPackage = $this->distPackageRepository->update($request->all(), $id);

        Flash::success('Dist Package updated successfully.');

        return redirect(route('distPackages.index'));
    }

    /**
     * Remove the specified dist_package from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_distPackages');
        $distPackage = $this->distPackageRepository->find($id);

        if (empty($distPackage)) {
            Flash::error('Dist Package not found');

            return redirect(route('distPackages.index'));
        }

        $this->distPackageRepository->delete($id);

        Flash::success('Dist Package deleted successfully.');

        return redirect(route('distPackages.index'));
    }
}
