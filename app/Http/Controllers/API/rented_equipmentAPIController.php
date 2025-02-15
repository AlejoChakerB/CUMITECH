<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createrented_equipmentAPIRequest;
use App\Http\Requests\API\Updaterented_equipmentAPIRequest;
use App\Models\rented_equipment;
use App\Repositories\rented_equipmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class rented_equipmentController
 * @package App\Http\Controllers\API
 */

class rented_equipmentAPIController extends AppBaseController
{
    /** @var  rented_equipmentRepository */
    private $rentedEquipmentRepository;

    public function __construct(rented_equipmentRepository $rentedEquipmentRepo)
    {
        $this->rentedEquipmentRepository = $rentedEquipmentRepo;
    }

    /**
     * Display a listing of the rented_equipment.
     * GET|HEAD /rentedEquipments
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $rentedEquipments = $this->rentedEquipmentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($rentedEquipments->toArray(), 'Rented Equipments retrieved successfully');
    }

    /**
     * Store a newly created rented_equipment in storage.
     * POST /rentedEquipments
     *
     * @param Createrented_equipmentAPIRequest $request
     *
     * @return Response
     */
    public function store(Createrented_equipmentAPIRequest $request)
    {
        $input = $request->all();

        $rentedEquipment = $this->rentedEquipmentRepository->create($input);

        return $this->sendResponse($rentedEquipment->toArray(), 'Rented Equipment saved successfully');
    }

    /**
     * Display the specified rented_equipment.
     * GET|HEAD /rentedEquipments/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var rented_equipment $rentedEquipment */
        $rentedEquipment = $this->rentedEquipmentRepository->find($id);

        if (empty($rentedEquipment)) {
            return $this->sendError('Rented Equipment not found');
        }

        return $this->sendResponse($rentedEquipment->toArray(), 'Rented Equipment retrieved successfully');
    }

    /**
     * Update the specified rented_equipment in storage.
     * PUT/PATCH /rentedEquipments/{id}
     *
     * @param int $id
     * @param Updaterented_equipmentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updaterented_equipmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var rented_equipment $rentedEquipment */
        $rentedEquipment = $this->rentedEquipmentRepository->find($id);

        if (empty($rentedEquipment)) {
            return $this->sendError('Rented Equipment not found');
        }

        $rentedEquipment = $this->rentedEquipmentRepository->update($input, $id);

        return $this->sendResponse($rentedEquipment->toArray(), 'rented_equipment updated successfully');
    }

    /**
     * Remove the specified rented_equipment from storage.
     * DELETE /rentedEquipments/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var rented_equipment $rentedEquipment */
        $rentedEquipment = $this->rentedEquipmentRepository->find($id);

        if (empty($rentedEquipment)) {
            return $this->sendError('Rented Equipment not found');
        }

        $rentedEquipment->delete();

        return $this->sendSuccess('Rented Equipment deleted successfully');
    }
}
