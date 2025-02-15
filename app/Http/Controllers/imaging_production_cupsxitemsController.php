<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createimaging_production_cupsxitemsRequest;
use App\Http\Requests\Updateimaging_production_cupsxitemsRequest;
use App\Repositories\imaging_production_cupsxitemsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\procedures;
use App\Models\articles;

class imaging_production_cupsxitemsController extends AppBaseController
{
    /** @var imaging_production_cupsxitemsRepository $imagingProductionCupsxitemsRepository*/
    private $imagingProductionCupsxitemsRepository;

    public function __construct(imaging_production_cupsxitemsRepository $imagingProductionCupsxitemsRepo)
    {
        $this->imagingProductionCupsxitemsRepository = $imagingProductionCupsxitemsRepo;
    }

    /**
     * Display a listing of the imaging_production_cupsxitems.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $imagingProductionCupsxitems = $this->imagingProductionCupsxitemsRepository->all();

        return view('imaging_production_cupsxitems.index')
            ->with('imagingProductionCupsxitems', $imagingProductionCupsxitems);
    }

    /**
     * Show the form for creating a new imaging_production_cupsxitems.
     *
     * @return Response
     */
    public function create()
    {
        $supplies = articles::orderby('item_code')->pluck('description', 'item_code');
        $procedures = Procedures::orderby('code')->pluck('code');
        return view('imaging_production_cupsxitems.create', compact('supplies', 'procedures'));
    }

    /**
     * Store a newly created imaging_production_cupsxitems in storage.
     *
     * @param Createimaging_production_cupsxitemsRequest $request
     *
     * @return Response
     */
    public function store(Createimaging_production_cupsxitemsRequest $request)
    {
        $input = $request->all();
        //dd($json);
        $imagingProductionCupsxitems = $this->imagingProductionCupsxitemsRepository->create($input);

        Flash::success('Imaging Production Cupsxitems saved successfully.');

        return redirect(route('imagingProductionCupsxitems.index'));
    }

    /**
     * Display the specified imaging_production_cupsxitems.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $imagingProductionCupsxitems = $this->imagingProductionCupsxitemsRepository->find($id);

        if (empty($imagingProductionCupsxitems)) {
            Flash::error('Imaging Production Cupsxitems not found');

            return redirect(route('imagingProductionCupsxitems.index'));
        }

        return view('imaging_production_cupsxitems.show')->with('imagingProductionCupsxitems', $imagingProductionCupsxitems);
    }

    /**
     * Show the form for editing the specified imaging_production_cupsxitems.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $imagingProductionCupsxitems = $this->imagingProductionCupsxitemsRepository->find($id);
        //dd($imagingProductionCupsxitems);
        if (empty($imagingProductionCupsxitems)) {
            Flash::error('Imaging Production Cupsxitems not found');

            return redirect(route('imagingProductionCupsxitems.index'));
        }

        return view('imaging_production_cupsxitems.edit', compact('imagingProductionCupsxitems'));
    }

    /**
     * Update the specified imaging_production_cupsxitems in storage.
     *
     * @param int $id
     * @param Updateimaging_production_cupsxitemsRequest $request
     *
     * @return Response
     */
    public function update($id, Updateimaging_production_cupsxitemsRequest $request)
    {
        $imagingProductionCupsxitems = $this->imagingProductionCupsxitemsRepository->find($id);

        if (empty($imagingProductionCupsxitems)) {
            Flash::error('Imaging Production Cupsxitems not found');

            return redirect(route('imagingProductionCupsxitems.index'));
        }

        $imagingProductionCupsxitems = $this->imagingProductionCupsxitemsRepository->update($request->all(), $id);

        Flash::success('Imaging Production Cupsxitems updated successfully.');

        return redirect(route('imagingProductionCupsxitems.index'));
    }

    /**
     * Remove the specified imaging_production_cupsxitems from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $imagingProductionCupsxitems = $this->imagingProductionCupsxitemsRepository->find($id);

        if (empty($imagingProductionCupsxitems)) {
            Flash::error('Imaging Production Cupsxitems not found');

            return redirect(route('imagingProductionCupsxitems.index'));
        }

        $this->imagingProductionCupsxitemsRepository->delete($id);

        Flash::success('Imaging Production Cupsxitems deleted successfully.');

        return redirect(route('imagingProductionCupsxitems.index'));
    }
}
