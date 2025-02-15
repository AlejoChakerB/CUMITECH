<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createlog_accommodation_costRequest;
use App\Http\Requests\Updatelog_accommodation_costRequest;
use App\Repositories\log_accommodation_costRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class log_accommodation_costController extends AppBaseController
{
    /** @var log_accommodation_costRepository $logAccommodationCostRepository*/
    private $logAccommodationCostRepository;

    public function __construct(log_accommodation_costRepository $logAccommodationCostRepo)
    {
        $this->logAccommodationCostRepository = $logAccommodationCostRepo;
    }

    /**
     * Display a listing of the log_accommodation_cost.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $logAccommodationCosts = $this->logAccommodationCostRepository->all();

        return view('log_accommodation_costs.index')
            ->with('logAccommodationCosts', $logAccommodationCosts);
    }

    /**
     * Show the form for creating a new log_accommodation_cost.
     *
     * @return Response
     */
    public function create()
    {
        return view('log_accommodation_costs.create');
    }

    /**
     * Store a newly created log_accommodation_cost in storage.
     *
     * @param Createlog_accommodation_costRequest $request
     *
     * @return Response
     */
    public function store(Createlog_accommodation_costRequest $request)
    {
        $input = $request->all();

        $logAccommodationCost = $this->logAccommodationCostRepository->create($input);

        Flash::success('Log Accommodation Cost saved successfully.');

        return redirect(route('logAccommodationCosts.index'));
    }

    /**
     * Display the specified log_accommodation_cost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $logAccommodationCost = $this->logAccommodationCostRepository->find($id);

        if (empty($logAccommodationCost)) {
            Flash::error('Log Accommodation Cost not found');

            return redirect(route('logAccommodationCosts.index'));
        }

        return view('log_accommodation_costs.show')->with('logAccommodationCost', $logAccommodationCost);
    }

    /**
     * Show the form for editing the specified log_accommodation_cost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $logAccommodationCost = $this->logAccommodationCostRepository->find($id);

        if (empty($logAccommodationCost)) {
            Flash::error('Log Accommodation Cost not found');

            return redirect(route('logAccommodationCosts.index'));
        }

        return view('log_accommodation_costs.edit')->with('logAccommodationCost', $logAccommodationCost);
    }

    /**
     * Update the specified log_accommodation_cost in storage.
     *
     * @param int $id
     * @param Updatelog_accommodation_costRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_accommodation_costRequest $request)
    {
        $logAccommodationCost = $this->logAccommodationCostRepository->find($id);

        if (empty($logAccommodationCost)) {
            Flash::error('Log Accommodation Cost not found');

            return redirect(route('logAccommodationCosts.index'));
        }

        $logAccommodationCost = $this->logAccommodationCostRepository->update($request->all(), $id);

        Flash::success('Log Accommodation Cost updated successfully.');

        return redirect(route('logAccommodationCosts.index'));
    }

    /**
     * Remove the specified log_accommodation_cost from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $logAccommodationCost = $this->logAccommodationCostRepository->find($id);

        if (empty($logAccommodationCost)) {
            Flash::error('Log Accommodation Cost not found');

            return redirect(route('logAccommodationCosts.index'));
        }

        $this->logAccommodationCostRepository->delete($id);

        Flash::success('Log Accommodation Cost deleted successfully.');

        return redirect(route('logAccommodationCosts.index'));
    }
}
