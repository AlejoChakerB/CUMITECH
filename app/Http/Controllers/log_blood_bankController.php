<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createlog_blood_bankRequest;
use App\Http\Requests\Updatelog_blood_bankRequest;
use App\Repositories\log_blood_bankRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class log_blood_bankController extends AppBaseController
{
    /** @var log_blood_bankRepository $logBloodBankRepository*/
    private $logBloodBankRepository;

    public function __construct(log_blood_bankRepository $logBloodBankRepo)
    {
        $this->logBloodBankRepository = $logBloodBankRepo;
    }

    /**
     * Display a listing of the log_blood_bank.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $logBloodBanks = $this->logBloodBankRepository->all();

        return view('log_blood_banks.index')
            ->with('logBloodBanks', $logBloodBanks);
    }

    /**
     * Show the form for creating a new log_blood_bank.
     *
     * @return Response
     */
    public function create()
    {
        return view('log_blood_banks.create');
    }

    /**
     * Store a newly created log_blood_bank in storage.
     *
     * @param Createlog_blood_bankRequest $request
     *
     * @return Response
     */
    public function store(Createlog_blood_bankRequest $request)
    {
        $input = $request->all();

        $logBloodBank = $this->logBloodBankRepository->create($input);

        Flash::success('Log Blood Bank saved successfully.');

        return redirect(route('logBloodBanks.index'));
    }

    /**
     * Display the specified log_blood_bank.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $logBloodBank = $this->logBloodBankRepository->find($id);

        if (empty($logBloodBank)) {
            Flash::error('Log Blood Bank not found');

            return redirect(route('logBloodBanks.index'));
        }

        return view('log_blood_banks.show')->with('logBloodBank', $logBloodBank);
    }

    /**
     * Show the form for editing the specified log_blood_bank.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $logBloodBank = $this->logBloodBankRepository->find($id);

        if (empty($logBloodBank)) {
            Flash::error('Log Blood Bank not found');

            return redirect(route('logBloodBanks.index'));
        }

        return view('log_blood_banks.edit')->with('logBloodBank', $logBloodBank);
    }

    /**
     * Update the specified log_blood_bank in storage.
     *
     * @param int $id
     * @param Updatelog_blood_bankRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_blood_bankRequest $request)
    {
        $logBloodBank = $this->logBloodBankRepository->find($id);

        if (empty($logBloodBank)) {
            Flash::error('Log Blood Bank not found');

            return redirect(route('logBloodBanks.index'));
        }

        $logBloodBank = $this->logBloodBankRepository->update($request->all(), $id);

        Flash::success('Log Blood Bank updated successfully.');

        return redirect(route('logBloodBanks.index'));
    }

    /**
     * Remove the specified log_blood_bank from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $logBloodBank = $this->logBloodBankRepository->find($id);

        if (empty($logBloodBank)) {
            Flash::error('Log Blood Bank not found');

            return redirect(route('logBloodBanks.index'));
        }

        $this->logBloodBankRepository->delete($id);

        Flash::success('Log Blood Bank deleted successfully.');

        return redirect(route('logBloodBanks.index'));
    }
}
