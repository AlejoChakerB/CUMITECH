<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createlog_ambulance_costRequest;
use App\Http\Requests\Updatelog_ambulance_costRequest;
use App\Repositories\log_ambulance_costRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class log_ambulance_costController extends AppBaseController
{
    /** @var log_ambulance_costRepository $logAmbulanceCostRepository*/
    private $logAmbulanceCostRepository;

    public function __construct(log_ambulance_costRepository $logAmbulanceCostRepo)
    {
        $this->logAmbulanceCostRepository = $logAmbulanceCostRepo;
    }

    /**
     * Display a listing of the log_ambulance_cost.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $logAmbulanceCosts = $this->logAmbulanceCostRepository->all();

        return view('log_ambulance_costs.index')
            ->with('logAmbulanceCosts', $logAmbulanceCosts);
    }

    /**
     * Show the form for creating a new log_ambulance_cost.
     *
     * @return Response
     */
    public function create()
    {
        return view('log_ambulance_costs.create');
    }

    /**
     * Store a newly created log_ambulance_cost in storage.
     *
     * @param Createlog_ambulance_costRequest $request
     *
     * @return Response
     */
    public function store(Createlog_ambulance_costRequest $request)
    {
        $input = $request->all();

        $logAmbulanceCost = $this->logAmbulanceCostRepository->create($input);

        Flash::success('Log Ambulance Cost saved successfully.');

        return redirect(route('logAmbulanceCosts.index'));
    }

    /**
     * Display the specified log_ambulance_cost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $logAmbulanceCost = $this->logAmbulanceCostRepository->find($id);

        if (empty($logAmbulanceCost)) {
            Flash::error('Log Ambulance Cost not found');

            return redirect(route('logAmbulanceCosts.index'));
        }

        return view('log_ambulance_costs.show')->with('logAmbulanceCost', $logAmbulanceCost);
    }

    /**
     * Show the form for editing the specified log_ambulance_cost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $logAmbulanceCost = $this->logAmbulanceCostRepository->find($id);

        if (empty($logAmbulanceCost)) {
            Flash::error('Log Ambulance Cost not found');

            return redirect(route('logAmbulanceCosts.index'));
        }

        return view('log_ambulance_costs.edit')->with('logAmbulanceCost', $logAmbulanceCost);
    }

    /**
     * Update the specified log_ambulance_cost in storage.
     *
     * @param int $id
     * @param Updatelog_ambulance_costRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_ambulance_costRequest $request)
    {
        $logAmbulanceCost = $this->logAmbulanceCostRepository->find($id);

        if (empty($logAmbulanceCost)) {
            Flash::error('Log Ambulance Cost not found');

            return redirect(route('logAmbulanceCosts.index'));
        }

        $logAmbulanceCost = $this->logAmbulanceCostRepository->update($request->all(), $id);

        Flash::success('Log Ambulance Cost updated successfully.');

        return redirect(route('logAmbulanceCosts.index'));
    }

    /**
     * Remove the specified log_ambulance_cost from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $logAmbulanceCost = $this->logAmbulanceCostRepository->find($id);

        if (empty($logAmbulanceCost)) {
            Flash::error('Log Ambulance Cost not found');

            return redirect(route('logAmbulanceCosts.index'));
        }

        $this->logAmbulanceCostRepository->delete($id);

        Flash::success('Log Ambulance Cost deleted successfully.');

        return redirect(route('logAmbulanceCosts.index'));
    }
}
