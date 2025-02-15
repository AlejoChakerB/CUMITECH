<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createlog_cumi_lab_rateRequest;
use App\Http\Requests\Updatelog_cumi_lab_rateRequest;
use App\Repositories\log_cumi_lab_rateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class log_cumi_lab_rateController extends AppBaseController
{
    /** @var log_cumi_lab_rateRepository $logCumiLabRateRepository*/
    private $logCumiLabRateRepository;

    public function __construct(log_cumi_lab_rateRepository $logCumiLabRateRepo)
    {
        $this->logCumiLabRateRepository = $logCumiLabRateRepo;
    }

    /**
     * Display a listing of the log_cumi_lab_rate.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $logCumiLabRates = $this->logCumiLabRateRepository->all();

        return view('log_cumi_lab_rates.index')
            ->with('logCumiLabRates', $logCumiLabRates);
    }

    /**
     * Show the form for creating a new log_cumi_lab_rate.
     *
     * @return Response
     */
    public function create()
    {
        return view('log_cumi_lab_rates.create');
    }

    /**
     * Store a newly created log_cumi_lab_rate in storage.
     *
     * @param Createlog_cumi_lab_rateRequest $request
     *
     * @return Response
     */
    public function store(Createlog_cumi_lab_rateRequest $request)
    {
        $input = $request->all();

        $logCumiLabRate = $this->logCumiLabRateRepository->create($input);

        Flash::success('Log Cumi Lab Rate saved successfully.');

        return redirect(route('logCumiLabRates.index'));
    }

    /**
     * Display the specified log_cumi_lab_rate.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $logCumiLabRate = $this->logCumiLabRateRepository->find($id);

        if (empty($logCumiLabRate)) {
            Flash::error('Log Cumi Lab Rate not found');

            return redirect(route('logCumiLabRates.index'));
        }

        return view('log_cumi_lab_rates.show')->with('logCumiLabRate', $logCumiLabRate);
    }

    /**
     * Show the form for editing the specified log_cumi_lab_rate.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $logCumiLabRate = $this->logCumiLabRateRepository->find($id);

        if (empty($logCumiLabRate)) {
            Flash::error('Log Cumi Lab Rate not found');

            return redirect(route('logCumiLabRates.index'));
        }

        return view('log_cumi_lab_rates.edit')->with('logCumiLabRate', $logCumiLabRate);
    }

    /**
     * Update the specified log_cumi_lab_rate in storage.
     *
     * @param int $id
     * @param Updatelog_cumi_lab_rateRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_cumi_lab_rateRequest $request)
    {
        $logCumiLabRate = $this->logCumiLabRateRepository->find($id);

        if (empty($logCumiLabRate)) {
            Flash::error('Log Cumi Lab Rate not found');

            return redirect(route('logCumiLabRates.index'));
        }

        $logCumiLabRate = $this->logCumiLabRateRepository->update($request->all(), $id);

        Flash::success('Log Cumi Lab Rate updated successfully.');

        return redirect(route('logCumiLabRates.index'));
    }

    /**
     * Remove the specified log_cumi_lab_rate from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $logCumiLabRate = $this->logCumiLabRateRepository->find($id);

        if (empty($logCumiLabRate)) {
            Flash::error('Log Cumi Lab Rate not found');

            return redirect(route('logCumiLabRates.index'));
        }

        $this->logCumiLabRateRepository->delete($id);

        Flash::success('Log Cumi Lab Rate deleted successfully.');

        return redirect(route('logCumiLabRates.index'));
    }
}
