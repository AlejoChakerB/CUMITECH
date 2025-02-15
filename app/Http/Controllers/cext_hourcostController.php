<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createcext_hourcostRequest;
use App\Http\Requests\Updatecext_hourcostRequest;
use App\Repositories\cext_hourcostRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\cext_production_month;
use App\Models\cext_hourcost;

class cext_hourcostController extends AppBaseController
{
    /** @var cext_hourcostRepository $cextHourcostRepository*/
    private $cextHourcostRepository;

    public function __construct(cext_hourcostRepository $cextHourcostRepo)
    {
        $this->cextHourcostRepository = $cextHourcostRepo;
    }

    /**
     * Display a listing of the cext_hourcost.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_cextHourcosts');
        $cextHourcosts = $this->cextHourcostRepository->all();

        return view('cext_hourcosts.index')
            ->with('cextHourcosts', $cextHourcosts);
    }

    /**
     * Show the form for creating a new cext_hourcost.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_cextHourcosts');
        return view('cext_hourcosts.create');
    }

    /**
     * Store a newly created cext_hourcost in storage.
     *
     * @param Createcext_hourcostRequest $request
     *
     * @return Response
     */
    public function store(Createcext_hourcostRequest $request)
    {
        $input = $request->all();
        if ($input['hours_producedxmonth'] == 0 || $input['number_room'] == 0) {
            Flash::error('Horas de producción al mes o cantidad de habitaciones tienen que ser diferentes de 0');
            return redirect(route('cextHourcosts.index'));
        }
        $duration = cext_production_month::sum('total_duration');
        $input['total_cost'] = $input['permanent_overhead'] + $input['variable_overhead'] + $input['administrative_twoLevel'] + $input['logistic_twoLevel'] + $input['labour']  + $input['plant_labour'];
        $input['room_valueTotal'] = $input['total_cost']/($duration/60);
        $input['room_value'] = $input['room_valueTotal']/$input['number_room'];

        $cextHourcost = $this->cextHourcostRepository->create($input);

        Flash::success('Cext Hourcost saved successfully.');

        return redirect(route('cextHourcosts.index'));
    }

    /**
     * Display the specified cext_hourcost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_cextHourcosts');
        $cextHourcost = $this->cextHourcostRepository->find($id);

        if (empty($cextHourcost)) {
            Flash::error('Cext Hourcost not found');

            return redirect(route('cextHourcosts.index'));
        }

        return view('cext_hourcosts.show')->with('cextHourcost', $cextHourcost);
    }

    /**
     * Show the form for editing the specified cext_hourcost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_cextHourcosts');
        $cextHourcost = $this->cextHourcostRepository->find($id);
        if (empty($cextHourcost)) {
            Flash::error('Cext Hourcost not found');

            return redirect(route('cextHourcosts.index'));
        }

        return view('cext_hourcosts.edit')->with('cextHourcost', $cextHourcost);
    }

    /**
     * Update the specified cext_hourcost in storage.
     *
     * @param int $id
     * @param Updatecext_hourcostRequest $request
     *
     * @return Response
     */
    public function update($id, Updatecext_hourcostRequest $request)
    {
        $cextHourcost = $this->cextHourcostRepository->find($id);
        $input = $request->all();
        
        if ($input['hours_producedxmonth'] == 0 || $input['number_room'] == 0) {
            Flash::error('Horas de producción al mes o cantidad de habitaciones tienen que ser diferentes de 0');
            return redirect(route('cextHourcosts.index'));
        }elseif (empty($cextHourcost)) {
            Flash::error('Cext Hourcost not found');
    
            return redirect(route('cextHourcosts.index'));
        }
        $input['total_cost'] = $input['permanent_overhead'] + $input['variable_overhead'] + $input['administrative_twoLevel'] + $input['logistic_twoLevel'] + $input['labour'] + $input['plant_labour'];
        $duration = cext_production_month::sum('total_duration');
        $input['room_valueTotal'] = $input['total_cost']/($duration/60);
        $input['room_value'] = $input['room_valueTotal']/$input['number_room'];
        //dd($input);
        $cextHourcost = $this->cextHourcostRepository->update($input, $id);

        Flash::success('Cext Hourcost updated successfully.');

        return redirect(route('cextHourcosts.index'));
    }

    public function editHour()
    {
        $this->authorize('show_cextProductionMonths');
        $cextHourcostid = cext_hourcost::whereNull('deleted_at')->first();
        $cextHourcost = $this->cextHourcostRepository->find($cextHourcostid->id);
        if (empty($cextHourcost)) {
            Flash::error('Cext Hourcost not found');

            return redirect(route('cextHourcosts.index'));
        }

        return view('cext_hourcosts.edit')->with('cextHourcost', $cextHourcost);
    }

    /**
     * Remove the specified cext_hourcost from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_cextHourcosts');
        $cextHourcost = $this->cextHourcostRepository->find($id);

        if (empty($cextHourcost)) {
            Flash::error('Cext Hourcost not found');

            return redirect(route('cextHourcosts.index'));
        }

        $this->cextHourcostRepository->delete($id);

        Flash::success('Cext Hourcost deleted successfully.');

        return redirect(route('cextHourcosts.index'));
    }
}
