<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createrented_equipmentRequest;
use App\Http\Requests\Updaterented_equipmentRequest;
use App\Repositories\rented_equipmentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Flash;
use Response;
use App\Models\Procedures;

class rented_equipmentController extends AppBaseController
{
    /** @var rented_equipmentRepository $rentedEquipmentRepository*/
    private $rentedEquipmentRepository;

    public function __construct(rented_equipmentRepository $rentedEquipmentRepo)
    {
        $this->rentedEquipmentRepository = $rentedEquipmentRepo;
    }

    /**
     * Display a listing of the rented_equipment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_rentedEquipments');
        $rentedEquipments = $this->rentedEquipmentRepository->all();

        return view('rented_equipments.index')
            ->with('rentedEquipments', $rentedEquipments);
    }

    /**
     * Show the form for creating a new rented_equipment.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_rentedEquipments');
        $procedures = Procedures::orderby('code')->get(['id', 'description', 'code'])
        ->mapWithKeys(function ($procedure) {
            return [$procedure->id => $procedure->description . ' - ' . $procedure->code];
        });
        return view('rented_equipments.create', compact('procedures'));
    }

    /**
     * Store a newly created rented_equipment in storage.
     *
     * @param Createrented_equipmentRequest $request
     *
     * @return Response
     */
    public function store(Createrented_equipmentRequest $request)
    {
        $input = $request->all();
        $rentedEquipment = $this->rentedEquipmentRepository->create($input);

        Flash::success('Rented Equipment saved successfully.');

        return redirect(route('rentedEquipments.index'));
    }

    /**
     * Display the specified rented_equipment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_rentedEquipments');
        $rentedEquipment = $this->rentedEquipmentRepository->find($id);

        if (empty($rentedEquipment)) {
            Flash::error('Rented Equipment not found');

            return redirect(route('rentedEquipments.index'));
        }

        return view('rented_equipments.show')->with('rentedEquipment', $rentedEquipment);
    }

    /**
     * Show the form for editing the specified rented_equipment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_rentedEquipments');
        $rentedEquipment = $this->rentedEquipmentRepository->find($id);

        if (empty($rentedEquipment)) {
            Flash::error('Rented Equipment not found');

            return redirect(route('rentedEquipments.index'));
        }

        return view('rented_equipments.edit')->with('rentedEquipment', $rentedEquipment);
    }

    /**
     * Update the specified rented_equipment in storage.
     *
     * @param int $id
     * @param Updaterented_equipmentRequest $request
     *
     * @return Response
     */
    public function update($id, Updaterented_equipmentRequest $request)
    {
        $rentedEquipment = $this->rentedEquipmentRepository->find($id);

        if (empty($rentedEquipment)) {
            Flash::error('Rented Equipment not found');

            return redirect(route('rentedEquipments.index'));
        }

        $rentedEquipment = $this->rentedEquipmentRepository->update($request->all(), $id);

        Flash::success('Rented Equipment updated successfully.');

        return redirect(route('rentedEquipments.index'));
    }

    /**
     * Remove the specified rented_equipment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_rentedEquipments');
        $rentedEquipment = $this->rentedEquipmentRepository->find($id);

        if (empty($rentedEquipment)) {
            Flash::error('Rented Equipment not found');

            return redirect(route('rentedEquipments.index'));
        }

        $this->rentedEquipmentRepository->delete($id);

        Flash::success('Rented Equipment deleted successfully.');

        return redirect(route('rentedEquipments.index'));
    }
}
