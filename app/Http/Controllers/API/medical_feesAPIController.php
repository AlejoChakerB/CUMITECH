<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createmedical_feesAPIRequest;
use App\Http\Requests\API\Updatemedical_feesAPIRequest;
use App\Models\medical_fees;
use App\Repositories\medical_feesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class medical_feesController
 * @package App\Http\Controllers\API
 */

class medical_feesAPIController extends AppBaseController
{
    /** @var  medical_feesRepository */
    private $medicalFeesRepository;

    public function __construct(medical_feesRepository $medicalFeesRepo)
    {
        $this->medicalFeesRepository = $medicalFeesRepo;
    }

    /**
     * Display a listing of the medical_fees.
     * GET|HEAD /medicalFees
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $medicalFees = $this->medicalFeesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($medicalFees->toArray(), 'Medical Fees retrieved successfully');
    }

    /**
     * Store a newly created medical_fees in storage.
     * POST /medicalFees
     *
     * @param Createmedical_feesAPIRequest $request
     *
     * @return Response
     */
    public function store(Createmedical_feesAPIRequest $request)
    {
        $input = $request->all();

        $medicalFees = $this->medicalFeesRepository->create($input);

        return $this->sendResponse($medicalFees->toArray(), 'Medical Fees saved successfully');
    }

    /**
     * Display the specified medical_fees.
     * GET|HEAD /medicalFees/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var medical_fees $medicalFees */
        $medicalFees = $this->medicalFeesRepository->find($id);

        if (empty($medicalFees)) {
            return $this->sendError('Medical Fees not found');
        }

        return $this->sendResponse($medicalFees->toArray(), 'Medical Fees retrieved successfully');
    }

    /**
     * Update the specified medical_fees in storage.
     * PUT/PATCH /medicalFees/{id}
     *
     * @param int $id
     * @param Updatemedical_feesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatemedical_feesAPIRequest $request)
    {
        $input = $request->all();

        /** @var medical_fees $medicalFees */
        $medicalFees = $this->medicalFeesRepository->find($id);

        if (empty($medicalFees)) {
            return $this->sendError('Medical Fees not found');
        }

        $medicalFees = $this->medicalFeesRepository->update($input, $id);

        return $this->sendResponse($medicalFees->toArray(), 'medical_fees updated successfully');
    }

    /**
     * Remove the specified medical_fees from storage.
     * DELETE /medicalFees/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var medical_fees $medicalFees */
        $medicalFees = $this->medicalFeesRepository->find($id);

        if (empty($medicalFees)) {
            return $this->sendError('Medical Fees not found');
        }

        $medicalFees->delete();

        return $this->sendSuccess('Medical Fees deleted successfully');
    }
}
