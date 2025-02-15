<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createlog_blood_bankAPIRequest;
use App\Http\Requests\API\Updatelog_blood_bankAPIRequest;
use App\Models\log_blood_bank;
use App\Repositories\log_blood_bankRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class log_blood_bankController
 * @package App\Http\Controllers\API
 */

class log_blood_bankAPIController extends AppBaseController
{
    /** @var  log_blood_bankRepository */
    private $logBloodBankRepository;

    public function __construct(log_blood_bankRepository $logBloodBankRepo)
    {
        $this->logBloodBankRepository = $logBloodBankRepo;
    }

    /**
     * Display a listing of the log_blood_bank.
     * GET|HEAD /logBloodBanks
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $logBloodBanks = $this->logBloodBankRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($logBloodBanks->toArray(), 'Log Blood Banks retrieved successfully');
    }

    /**
     * Store a newly created log_blood_bank in storage.
     * POST /logBloodBanks
     *
     * @param Createlog_blood_bankAPIRequest $request
     *
     * @return Response
     */
    public function store(Createlog_blood_bankAPIRequest $request)
    {
        $input = $request->all();

        $logBloodBank = $this->logBloodBankRepository->create($input);

        return $this->sendResponse($logBloodBank->toArray(), 'Log Blood Bank saved successfully');
    }

    /**
     * Display the specified log_blood_bank.
     * GET|HEAD /logBloodBanks/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var log_blood_bank $logBloodBank */
        $logBloodBank = $this->logBloodBankRepository->find($id);

        if (empty($logBloodBank)) {
            return $this->sendError('Log Blood Bank not found');
        }

        return $this->sendResponse($logBloodBank->toArray(), 'Log Blood Bank retrieved successfully');
    }

    /**
     * Update the specified log_blood_bank in storage.
     * PUT/PATCH /logBloodBanks/{id}
     *
     * @param int $id
     * @param Updatelog_blood_bankAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_blood_bankAPIRequest $request)
    {
        $input = $request->all();

        /** @var log_blood_bank $logBloodBank */
        $logBloodBank = $this->logBloodBankRepository->find($id);

        if (empty($logBloodBank)) {
            return $this->sendError('Log Blood Bank not found');
        }

        $logBloodBank = $this->logBloodBankRepository->update($input, $id);

        return $this->sendResponse($logBloodBank->toArray(), 'log_blood_bank updated successfully');
    }

    /**
     * Remove the specified log_blood_bank from storage.
     * DELETE /logBloodBanks/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var log_blood_bank $logBloodBank */
        $logBloodBank = $this->logBloodBankRepository->find($id);

        if (empty($logBloodBank)) {
            return $this->sendError('Log Blood Bank not found');
        }

        $logBloodBank->delete();

        return $this->sendSuccess('Log Blood Bank deleted successfully');
    }
}
