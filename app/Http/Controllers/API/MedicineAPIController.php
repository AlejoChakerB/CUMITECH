<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMedicineAPIRequest;
use App\Http\Requests\API\UpdateMedicineAPIRequest;
use App\Models\Medicine;
use App\Repositories\MedicineRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MedicineController
 * @package App\Http\Controllers\API
 */

class MedicineAPIController extends AppBaseController
{
    /** @var  MedicineRepository */
    private $medicineRepository;

    public function __construct(MedicineRepository $medicineRepo)
    {
        $this->medicineRepository = $medicineRepo;
    }

    /**
     * Display a listing of the Medicine.
     * GET|HEAD /medicines
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $medicines = $this->medicineRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($medicines->toArray(), 'Medicines retrieved successfully');
    }

    /**
     * Store a newly created Medicine in storage.
     * POST /medicines
     *
     * @param CreateMedicineAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMedicineAPIRequest $request)
    {
        $input = $request->all();

        $medicine = $this->medicineRepository->create($input);

        return $this->sendResponse($medicine->toArray(), 'Medicine saved successfully');
    }

    /**
     * Display the specified Medicine.
     * GET|HEAD /medicines/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Medicine $medicine */
        $medicine = $this->medicineRepository->find($id);

        if (empty($medicine)) {
            return $this->sendError('Medicine not found');
        }

        return $this->sendResponse($medicine->toArray(), 'Medicine retrieved successfully');
    }

    /**
     * Update the specified Medicine in storage.
     * PUT/PATCH /medicines/{id}
     *
     * @param int $id
     * @param UpdateMedicineAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedicineAPIRequest $request)
    {
        $input = $request->all();

        /** @var Medicine $medicine */
        $medicine = $this->medicineRepository->find($id);

        if (empty($medicine)) {
            return $this->sendError('Medicine not found');
        }

        $medicine = $this->medicineRepository->update($input, $id);

        return $this->sendResponse($medicine->toArray(), 'Medicine updated successfully');
    }

    /**
     * Remove the specified Medicine from storage.
     * DELETE /medicines/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Medicine $medicine */
        $medicine = $this->medicineRepository->find($id);

        if (empty($medicine)) {
            return $this->sendError('Medicine not found');
        }

        $medicine->delete();

        return $this->sendSuccess('Medicine deleted successfully');
    }
}
