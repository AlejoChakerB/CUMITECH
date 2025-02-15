<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use App\Repositories\MedicineRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Invima_registration;
use App\Models\MedicationTemplate;
use App\Models\Medicine;

class MedicineController extends AppBaseController
{
    /** @var MedicineRepository $medicineRepository*/
    private $medicineRepository;

    public function __construct(MedicineRepository $medicineRepo)
    {
        $this->medicineRepository = $medicineRepo;
    }

    /**
     * Display a listing of the Medicine.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_medicines');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $medicinesQuery = Medicine::query();

        if (!empty($search)) {
            $medicinesQuery->where('admission_date', 'LIKE', '%' . $search . '%')
                        ->orWhere('act_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('generic_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('tradename', 'LIKE', '%' . $search . '%')
                        ->orWhere('pharmaceutical_form', 'LIKE', '%' . $search . '%')
                        ->orWhere('presentation', 'LIKE', '%' . $search . '%')
                        ->orWhere('expiration_date', 'LIKE', '%' . $search . '%')
                        ->orWhere('lot_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('registration_validity', 'LIKE', '%' . $search . '%')
                        ->orWhere('manufacturer_laboratory', 'LIKE', '%' . $search . '%')
                        ->orWhere('entered_by', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('invima_registration', function ($query) use ($search) {
                            $query->where('health_register', 'LIKE', '%' . $search . '%');
                        });
        }

        $medicines = $medicinesQuery->paginate($perPage);

        return view('medicines.index')
            ->with('medicines', $medicines);
    }

    /**
     * Show the form for creating a new Medicine.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_medicines');
        $invima = Invima_registration::all();
        $plantilla = MedicationTemplate::all();
        $lastActNumber = Medicine::latest('act_number')->value('act_number');
        $temperature = 'N/A';
        $lastFact = Medicine::latest('invoice_number')->value('invoice_number');
        return view('medicines.create', compact('invima', 'plantilla', 'lastActNumber', 'temperature', 'lastFact'));
    }

    /**
     * Store a newly created Medicine in storage.
     *
     * @param CreateMedicineRequest $request
     *
     * @return Response
     */
    public function store(CreateMedicineRequest $request)
    {
        $this->authorize('create_medicines');
        $input = $request->all();
        $medicine = $this->medicineRepository->create($input);

        session()->flash('success', "¡¡Acta registrada con éxito!!");
        return redirect(route('medicines.index'));
    }

    /**
     * Display the specified Medicine.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_medicines');
        $medicine = $this->medicineRepository->find($id);

        if (empty($medicine)) {
            Flash::error('Medicine not found');

            return redirect(route('medicines.index'));
        }

        return view('medicines.show')->with('medicine', $medicine);
    }

    /**
     * Show the form for editing the specified Medicine.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_medicines');
        $medicine = $this->medicineRepository->find($id);
        if (empty($medicine)) {
            Flash::error('Medicine not found');

            return redirect(route('medicines.index'));
        }
        
        $temperature = $medicine->arrival_temperature;
        $today = $medicine->admission_date;
        $lastActNumber = $medicine->act_number;
        $lastFact = $medicine->invoice_number;
        $invima = Invima_registration::all();
        $plantilla = MedicationTemplate::all();

        return view('medicines.edit', compact('medicine', 'temperature', 'today', 'lastActNumber', 'lastFact', 'plantilla', 'invima'));
    }

    /**
     * Update the specified Medicine in storage.
     *
     * @param int $id
     * @param UpdateMedicineRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedicineRequest $request)
    {
        $this->authorize('update_medicines');
        $medicine = $this->medicineRepository->find($id);
        //dd($request->all());
        if (empty($request)) {
            Flash::error('Medicine not found');

            return redirect(route('medicines.index'));
        }

        $medicine = $this->medicineRepository->update($request->all(), $id);

        session()->flash('success', "¡¡Acta actualizada con éxito!!");

        return redirect(route('medicines.index'));
    }

    /**
     * Remove the specified Medicine from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_medicines');
        $medicine = $this->medicineRepository->find($id);

        if (empty($medicine)) {
            Flash::error('Medicine not found');

            return redirect(route('medicines.index'));
        }

        $this->medicineRepository->delete($id);

        session()->flash('success', "¡¡Acta eliminada con éxito!!");

        return redirect(route('medicines.index'));
    }
}
