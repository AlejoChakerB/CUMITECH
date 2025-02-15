<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createlog_diferential_ratesRequest;
use App\Http\Requests\Updatelog_diferential_ratesRequest;
use App\Repositories\log_diferential_ratesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class log_diferential_ratesController extends AppBaseController
{
    /** @var log_diferential_ratesRepository $logDiferentialRatesRepository*/
    private $logDiferentialRatesRepository;

    public function __construct(log_diferential_ratesRepository $logDiferentialRatesRepo)
    {
        $this->logDiferentialRatesRepository = $logDiferentialRatesRepo;
    }

    /**
     * Display a listing of the log_diferential_rates.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $logDiferentialRates = $this->logDiferentialRatesRepository->all();

        return view('log_diferential_rates.index')
            ->with('logDiferentialRates', $logDiferentialRates);
    }

    /**
     * Show the form for creating a new log_diferential_rates.
     *
     * @return Response
     */
    public function create()
    {
        return view('log_diferential_rates.create');
    }

    /**
     * Store a newly created log_diferential_rates in storage.
     *
     * @param Createlog_diferential_ratesRequest $request
     *
     * @return Response
     */
    public function store(Createlog_diferential_ratesRequest $request)
    {
        $input = $request->all();

        $logDiferentialRates = $this->logDiferentialRatesRepository->create($input);

        Flash::success('Log Diferential Rates saved successfully.');

        return redirect(route('logDiferentialRates.index'));
    }

    /**
     * Display the specified log_diferential_rates.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $logDiferentialRates = $this->logDiferentialRatesRepository->find($id);

        if (empty($logDiferentialRates)) {
            Flash::error('Log Diferential Rates not found');

            return redirect(route('logDiferentialRates.index'));
        }

        return view('log_diferential_rates.show')->with('logDiferentialRates', $logDiferentialRates);
    }

    /**
     * Show the form for editing the specified log_diferential_rates.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $logDiferentialRates = $this->logDiferentialRatesRepository->find($id);

        if (empty($logDiferentialRates)) {
            Flash::error('Log Diferential Rates not found');

            return redirect(route('logDiferentialRates.index'));
        }

        return view('log_diferential_rates.edit')->with('logDiferentialRates', $logDiferentialRates);
    }

    /**
     * Update the specified log_diferential_rates in storage.
     *
     * @param int $id
     * @param Updatelog_diferential_ratesRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_diferential_ratesRequest $request)
    {
        $logDiferentialRates = $this->logDiferentialRatesRepository->find($id);

        if (empty($logDiferentialRates)) {
            Flash::error('Log Diferential Rates not found');

            return redirect(route('logDiferentialRates.index'));
        }

        $logDiferentialRates = $this->logDiferentialRatesRepository->update($request->all(), $id);

        Flash::success('Log Diferential Rates updated successfully.');

        return redirect(route('logDiferentialRates.index'));
    }

    /**
     * Remove the specified log_diferential_rates from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $logDiferentialRates = $this->logDiferentialRatesRepository->find($id);

        if (empty($logDiferentialRates)) {
            Flash::error('Log Diferential Rates not found');

            return redirect(route('logDiferentialRates.index'));
        }

        $this->logDiferentialRatesRepository->delete($id);

        Flash::success('Log Diferential Rates deleted successfully.');

        return redirect(route('logDiferentialRates.index'));
    }
}
