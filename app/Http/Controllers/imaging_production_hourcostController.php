<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createimaging_production_hourcostRequest;
use App\Http\Requests\Updateimaging_production_hourcostRequest;
use App\Repositories\imaging_production_hourcostRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\imaging_production_month;
use App\Models\imaging_production_hourcost;

class imaging_production_hourcostController extends AppBaseController
{
    /** @var imaging_production_hourcostRepository $imagingProductionHourcostRepository*/
    private $imagingProductionHourcostRepository;

    public function __construct(imaging_production_hourcostRepository $imagingProductionHourcostRepo)
    {
        $this->imagingProductionHourcostRepository = $imagingProductionHourcostRepo;
    }

    /**
     * Display a listing of the imaging_production_hourcost.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_imagingProductionHourcosts');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $imagingProductionHourcostsQuery = imaging_production_hourcost::query();

        if (!empty($search)) {
            $imagingProductionHourcostsQuery->where('service', 'LIKE', '%' . $search . '%');
        }

        $imagingProductionHourcosts = $imagingProductionHourcostsQuery->orderBy('service')->paginate($perPage);

        return view('imaging_production_hourcosts.index')
            ->with('imagingProductionHourcosts', $imagingProductionHourcosts);
    }

    /**
     * Show the form for creating a new imaging_production_hourcost.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_imagingProductionHourcosts');
        return view('imaging_production_hourcosts.create');
    }

    /**
     * Store a newly created imaging_production_hourcost in storage.
     *
     * @param Createimaging_production_hourcostRequest $request
     *
     * @return Response
     */
    public function store(Createimaging_production_hourcostRequest $request)
    {
        $input = $request->all();
        $duration = Imaging_production_month::where('service', $input['service'])->sum('total_duration');
        $totalCost = $input['permanent_overhead'] + $input['variable_overhead'] + $input['administrative_twoLevel'] + $input['logistic_twoLevel'] + $input['plant_labour'] + $input['supplies'];
        $hourValue = $totalCost/$duration;
        $hourValueRoom = $hourValue/$input['number_rooms'];
        $input['total_cost'] = $totalCost;
        $input['hour_value'] = $hourValue;
        $input['hour_value_room'] = $hourValueRoom;
        $imagingProductionHourcost = $this->imagingProductionHourcostRepository->create($input);

        session()->flash('success', "¡¡Costo hora para el servicio de " . $input['service'] . " agregado correctamente!!");

        return redirect(route('imagingProductionHourcosts.index'));
    }

    /**
     * Display the specified imaging_production_hourcost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_imagingProductionHourcosts');
        $imagingProductionHourcost = $this->imagingProductionHourcostRepository->find($id);

        if (empty($imagingProductionHourcost)) {
            Flash::error('Imaging Production Hourcost not found');

            return redirect(route('imagingProductionHourcosts.index'));
        }

        return view('imaging_production_hourcosts.show')->with('imagingProductionHourcost', $imagingProductionHourcost);
    }

    /**
     * Show the form for editing the specified imaging_production_hourcost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_imagingProductionHourcosts');
        $imagingProductionHourcost = $this->imagingProductionHourcostRepository->find($id);

        if (empty($imagingProductionHourcost)) {
            Flash::error('Imaging Production Hourcost not found');

            return redirect(route('imagingProductionHourcosts.index'));
        }

        return view('imaging_production_hourcosts.edit')->with('imagingProductionHourcost', $imagingProductionHourcost);
    }

    /**
     * Update the specified imaging_production_hourcost in storage.
     *
     * @param int $id
     * @param Updateimaging_production_hourcostRequest $request
     *
     * @return Response
     */
    public function update($id, Updateimaging_production_hourcostRequest $request)
    {
        $imagingProductionHourcost = $this->imagingProductionHourcostRepository->find($id);
        $input = $request->all();
        $duration = Imaging_production_month::where('service', $input['service'])->sum('total_duration');
        $totalCost = $input['permanent_overhead'] + $input['variable_overhead'] + $input['administrative_twoLevel'] + $input['logistic_twoLevel'] + $input['plant_labour'] + $input['supplies'];
        $hourValue = $totalCost/$duration;
        $hourValueRoom = $hourValue/$input['number_rooms'];
        $input['total_cost'] = $totalCost;
        $input['hour_value'] = $hourValue;
        $input['hour_value_room'] = $hourValueRoom;
        if (empty($imagingProductionHourcost)) {
            Flash::error('Imaging Production Hourcost not found');

            return redirect(route('imagingProductionHourcosts.index'));
        }

        $imagingProductionHourcost = $this->imagingProductionHourcostRepository->update($input, $id);

        session()->flash('success', "¡¡Costo hora para el servicio de " . $input['service'] . " actualizado correctamente!!");

        return redirect(route('imagingProductionHourcosts.index'));
    }

    /**
     * Remove the specified imaging_production_hourcost from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_imagingProductionHourcosts');
        $imagingProductionHourcost = $this->imagingProductionHourcostRepository->find($id);

        if (empty($imagingProductionHourcost)) {
            Flash::error('Imaging Production Hourcost not found');

            return redirect(route('imagingProductionHourcosts.index'));
        }

        $this->imagingProductionHourcostRepository->delete($id);

        session()->flash('success', "¡¡Costo hora para el servicio de " . $imagingProductionHourcost->service . " eliminado correctamente!!");

        return redirect(route('imagingProductionHourcosts.index'));
    }
}
