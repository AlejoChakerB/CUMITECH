<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createdetail_packages_tempRequest;
use App\Http\Requests\Updatedetail_packages_tempRequest;
use App\Repositories\detail_packages_tempRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class detail_packages_tempController extends AppBaseController
{
    /** @var detail_packages_tempRepository $detailPackagesTempRepository*/
    private $detailPackagesTempRepository;

    public function __construct(detail_packages_tempRepository $detailPackagesTempRepo)
    {
        $this->detailPackagesTempRepository = $detailPackagesTempRepo;
    }

    /**
     * Display a listing of the detail_packages_temp.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $detailPackagesTemps = $this->detailPackagesTempRepository->all();

        return view('detail_packages_temps.index')
            ->with('detailPackagesTemps', $detailPackagesTemps);
    }

    /**
     * Show the form for creating a new detail_packages_temp.
     *
     * @return Response
     */
    public function create()
    {
        return view('detail_packages_temps.create');
    }

    /**
     * Store a newly created detail_packages_temp in storage.
     *
     * @param Createdetail_packages_tempRequest $request
     *
     * @return Response
     */
    public function store(Createdetail_packages_tempRequest $request)
    {
        $input = $request->all();

        $detailPackagesTemp = $this->detailPackagesTempRepository->create($input);

        Flash::success('Detail Packages Temp saved successfully.');

        return redirect(route('detailPackagesTemps.index'));
    }

    /**
     * Display the specified detail_packages_temp.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $detailPackagesTemp = $this->detailPackagesTempRepository->find($id);

        if (empty($detailPackagesTemp)) {
            Flash::error('Detail Packages Temp not found');

            return redirect(route('detailPackagesTemps.index'));
        }

        return view('detail_packages_temps.show')->with('detailPackagesTemp', $detailPackagesTemp);
    }

    /**
     * Show the form for editing the specified detail_packages_temp.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $detailPackagesTemp = $this->detailPackagesTempRepository->find($id);

        if (empty($detailPackagesTemp)) {
            Flash::error('Detail Packages Temp not found');

            return redirect(route('detailPackagesTemps.index'));
        }

        return view('detail_packages_temps.edit')->with('detailPackagesTemp', $detailPackagesTemp);
    }

    /**
     * Update the specified detail_packages_temp in storage.
     *
     * @param int $id
     * @param Updatedetail_packages_tempRequest $request
     *
     * @return Response
     */
    public function update($id, Updatedetail_packages_tempRequest $request)
    {
        $detailPackagesTemp = $this->detailPackagesTempRepository->find($id);

        if (empty($detailPackagesTemp)) {
            Flash::error('Detail Packages Temp not found');

            return redirect(route('detailPackagesTemps.index'));
        }

        $detailPackagesTemp = $this->detailPackagesTempRepository->update($request->all(), $id);

        Flash::success('Detail Packages Temp updated successfully.');

        return redirect(route('detailPackagesTemps.index'));
    }

    /**
     * Remove the specified detail_packages_temp from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $detailPackagesTemp = $this->detailPackagesTempRepository->find($id);

        if (empty($detailPackagesTemp)) {
            Flash::error('Detail Packages Temp not found');

            return redirect(route('detailPackagesTemps.index'));
        }

        $this->detailPackagesTempRepository->delete($id);

        Flash::success('Detail Packages Temp deleted successfully.');

        return redirect(route('detailPackagesTemps.index'));
    }
}
