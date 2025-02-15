<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createblood_bank_monthAPIRequest;
use App\Http\Requests\API\Updateblood_bank_monthAPIRequest;
use App\Models\blood_bank_month;
use App\Repositories\blood_bank_monthRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class blood_bank_monthController
 * @package App\Http\Controllers\API
 */

class blood_bank_monthAPIController extends AppBaseController
{
    /** @var  blood_bank_monthRepository */
    private $bloodBankMonthRepository;

    public function __construct(blood_bank_monthRepository $bloodBankMonthRepo)
    {
        $this->bloodBankMonthRepository = $bloodBankMonthRepo;
    }

    /**
     * Display a listing of the blood_bank_month.
     * GET|HEAD /bloodBankMonths
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $bloodBankMonths = $this->bloodBankMonthRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($bloodBankMonths->toArray(), 'Blood Bank Months retrieved successfully');
    }

    /**
     * Store a newly created blood_bank_month in storage.
     * POST /bloodBankMonths
     *
     * @param Createblood_bank_monthAPIRequest $request
     *
     * @return Response
     */
    public function store(Createblood_bank_monthAPIRequest $request)
    {
        $input = $request->all();

        $bloodBankMonth = $this->bloodBankMonthRepository->create($input);

        return $this->sendResponse($bloodBankMonth->toArray(), 'Blood Bank Month saved successfully');
    }

    /**
     * Display the specified blood_bank_month.
     * GET|HEAD /bloodBankMonths/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var blood_bank_month $bloodBankMonth */
        $bloodBankMonth = $this->bloodBankMonthRepository->find($id);

        if (empty($bloodBankMonth)) {
            return $this->sendError('Blood Bank Month not found');
        }

        return $this->sendResponse($bloodBankMonth->toArray(), 'Blood Bank Month retrieved successfully');
    }

    /**
     * Update the specified blood_bank_month in storage.
     * PUT/PATCH /bloodBankMonths/{id}
     *
     * @param int $id
     * @param Updateblood_bank_monthAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateblood_bank_monthAPIRequest $request)
    {
        $input = $request->all();

        /** @var blood_bank_month $bloodBankMonth */
        $bloodBankMonth = $this->bloodBankMonthRepository->find($id);

        if (empty($bloodBankMonth)) {
            return $this->sendError('Blood Bank Month not found');
        }

        $bloodBankMonth = $this->bloodBankMonthRepository->update($input, $id);

        return $this->sendResponse($bloodBankMonth->toArray(), 'blood_bank_month updated successfully');
    }

    /**
     * Remove the specified blood_bank_month from storage.
     * DELETE /bloodBankMonths/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var blood_bank_month $bloodBankMonth */
        $bloodBankMonth = $this->bloodBankMonthRepository->find($id);

        if (empty($bloodBankMonth)) {
            return $this->sendError('Blood Bank Month not found');
        }

        $bloodBankMonth->delete();

        return $this->sendSuccess('Blood Bank Month deleted successfully');
    }
}
