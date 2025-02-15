<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createdetail_packageRequest;
use App\Http\Requests\Updatedetail_packageRequest;
use App\Repositories\detail_packageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\detail_package;

class detail_packageController extends AppBaseController
{
    /** @var detail_packageRepository $detailPackageRepository*/
    private $detailPackageRepository;

    public function __construct(detail_packageRepository $detailPackageRepo)
    {
        $this->detailPackageRepository = $detailPackageRepo;
    }

    /**
     * Display a listing of the detail_package.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_detailPackages');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $detailPackagesQuery = detail_package::query();

        if (!empty($search)) {
            $detailPackagesQuery->where('id_factu', 'LIKE', '%' . $search . '%')
            ->orWhere('study', 'LIKE', '%' . $search . '%');
        }

        $detailPackages = $detailPackagesQuery->orderBy('id', 'DESC')->paginate($perPage);

        return view('detail_packages.index')
            ->with('detailPackages', $detailPackages);
    }

    /**
     * Show the form for creating a new detail_package.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_detailPackages');
        return view('detail_packages.create');
    }

    /**
     * Store a newly created detail_package in storage.
     *
     * @param Createdetail_packageRequest $request
     *
     * @return Response
     */
    public function store(Createdetail_packageRequest $request)
    {
        $input = $request->all();

        $detailPackage = $this->detailPackageRepository->create($input);

        Flash::success('Detail Package saved successfully.');

        return redirect(route('detailPackages.index'));
    }

    /**
     * Display the specified detail_package.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_detailPackages');
        $detailPackage = $this->detailPackageRepository->find($id);

        if (empty($detailPackage)) {
            Flash::error('Detail Package not found');

            return redirect(route('detailPackages.index'));
        }

        return view('detail_packages.show')->with('detailPackage', $detailPackage);
    }

    /**
     * Show the form for editing the specified detail_package.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_detailPackages');
        $detailPackage = $this->detailPackageRepository->find($id);

        if (empty($detailPackage)) {
            Flash::error('Detail Package not found');

            return redirect(route('detailPackages.index'));
        }

        return view('detail_packages.edit')->with('detailPackage', $detailPackage);
    }

    /**
     * Update the specified detail_package in storage.
     *
     * @param int $id
     * @param Updatedetail_packageRequest $request
     *
     * @return Response
     */
    public function update($id, Updatedetail_packageRequest $request)
    {
        $detailPackage = $this->detailPackageRepository->find($id);

        if (empty($detailPackage)) {
            Flash::error('Detail Package not found');

            return redirect(route('detailPackages.index'));
        }

        $detailPackage = $this->detailPackageRepository->update($request->all(), $id);

        Flash::success('Detail Package updated successfully.');

        return redirect(route('detailPackages.index'));
    }

    /**
     * Remove the specified detail_package from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_detailPackages');
        $detailPackage = $this->detailPackageRepository->find($id);

        if (empty($detailPackage)) {
            Flash::error('Detail Package not found');

            return redirect(route('detailPackages.index'));
        }

        $this->detailPackageRepository->delete($id);

        Flash::success('Detail Package deleted successfully.');

        return redirect(route('detailPackages.index'));
    }
}
