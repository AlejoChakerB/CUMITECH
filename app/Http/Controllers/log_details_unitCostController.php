<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createlog_details_unitCostRequest;
use App\Http\Requests\Updatelog_details_unitCostRequest;
use App\Repositories\log_details_unitCostRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class log_details_unitCostController extends AppBaseController
{
    /** @var log_details_unitCostRepository $logDetailsUnitCostRepository*/
    private $logDetailsUnitCostRepository;

    public function __construct(log_details_unitCostRepository $logDetailsUnitCostRepo)
    {
        $this->logDetailsUnitCostRepository = $logDetailsUnitCostRepo;
    }

    /**
     * Display a listing of the log_details_unitCost.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $logDetailsUnitCosts = $this->logDetailsUnitCostRepository->all();

        return view('log_details_unit_costs.index')
            ->with('logDetailsUnitCosts', $logDetailsUnitCosts);
    }

    /**
     * Show the form for creating a new log_details_unitCost.
     *
     * @return Response
     */
    public function create()
    {
        return view('log_details_unit_costs.create');
    }

    /**
     * Store a newly created log_details_unitCost in storage.
     *
     * @param Createlog_details_unitCostRequest $request
     *
     * @return Response
     */
    public function store(Createlog_details_unitCostRequest $request)
    {
        $input = $request->all();

        $logDetailsUnitCost = $this->logDetailsUnitCostRepository->create($input);

        Flash::success('Log Details Unit Cost saved successfully.');

        return redirect(route('logDetailsUnitCosts.index'));
    }

    /**
     * Display the specified log_details_unitCost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $logDetailsUnitCost = $this->logDetailsUnitCostRepository->find($id);

        if (empty($logDetailsUnitCost)) {
            Flash::error('Log Details Unit Cost not found');

            return redirect(route('logDetailsUnitCosts.index'));
        }

        return view('log_details_unit_costs.show')->with('logDetailsUnitCost', $logDetailsUnitCost);
    }

    /**
     * Show the form for editing the specified log_details_unitCost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $logDetailsUnitCost = $this->logDetailsUnitCostRepository->find($id);

        if (empty($logDetailsUnitCost)) {
            Flash::error('Log Details Unit Cost not found');

            return redirect(route('logDetailsUnitCosts.index'));
        }

        return view('log_details_unit_costs.edit')->with('logDetailsUnitCost', $logDetailsUnitCost);
    }

    /**
     * Update the specified log_details_unitCost in storage.
     *
     * @param int $id
     * @param Updatelog_details_unitCostRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_details_unitCostRequest $request)
    {
        $logDetailsUnitCost = $this->logDetailsUnitCostRepository->find($id);

        if (empty($logDetailsUnitCost)) {
            Flash::error('Log Details Unit Cost not found');

            return redirect(route('logDetailsUnitCosts.index'));
        }

        $logDetailsUnitCost = $this->logDetailsUnitCostRepository->update($request->all(), $id);

        Flash::success('Log Details Unit Cost updated successfully.');

        return redirect(route('logDetailsUnitCosts.index'));
    }

    /**
     * Remove the specified log_details_unitCost from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $logDetailsUnitCost = $this->logDetailsUnitCostRepository->find($id);

        if (empty($logDetailsUnitCost)) {
            Flash::error('Log Details Unit Cost not found');

            return redirect(route('logDetailsUnitCosts.index'));
        }

        $this->logDetailsUnitCostRepository->delete($id);

        Flash::success('Log Details Unit Cost deleted successfully.');

        return redirect(route('logDetailsUnitCosts.index'));
    }
}
