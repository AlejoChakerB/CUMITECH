<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createmedical_feesRequest;
use App\Http\Requests\Updatemedical_feesRequest;
use App\Repositories\medical_feesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Medical_fees;
use Flash;
use Response;

class medical_feesController extends AppBaseController
{
    /** @var medical_feesRepository $medicalFeesRepository*/
    private $medicalFeesRepository;

    public function __construct(medical_feesRepository $medicalFeesRepo)
    {
        $this->medicalFeesRepository = $medicalFeesRepo;
    }

    /**
     * Display a listing of the medical_fees.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_medicalFees');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $medicalFeesQuery = Medical_fees::query();

        if (!empty($search)) {
            $medicalFeesQuery->where('honorary_code', 'LIKE', '%' . $search . '%')
                    ->orWhere('payment_manual', 'LIKE', '%' . $search . '%')
                    ->orWhere('fees_type', 'LIKE', '%' . $search . '%');
        }

        $medicalFees = $medicalFeesQuery->orderby('honorary_code')->paginate($perPage);

        return view('medical_fees.index', compact('medicalFees'));
    }

    /**
     * Show the form for creating a new medical_fees.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_medicalFees');
        return view('medical_fees.create');
    }

    /**
     * Store a newly created medical_fees in storage.
     *
     * @param Createmedical_feesRequest $request
     *
     * @return Response
     */
    public function store(Createmedical_feesRequest $request)
    {
        $this->authorize('create_medicalFees');
        $input = $request->all();

        $medicalFees = $this->medicalFeesRepository->create($input);

        Flash::success('Medical Fees saved successfully.');

        return redirect(route('medicalFees.index'));
    }

    /**
     * Display the specified medical_fees.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_medicalFees');
        $medicalFees = $this->medicalFeesRepository->find($id);

        if (empty($medicalFees)) {
            Flash::error('Medical Fees not found');

            return redirect(route('medicalFees.index'));
        }

        return view('medical_fees.show')->with('medicalFees', $medicalFees);
    }

    /**
     * Show the form for editing the specified medical_fees.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_medicalFees');
        $medicalFees = $this->medicalFeesRepository->find($id);

        if (empty($medicalFees)) {
            Flash::error('Medical Fees not found');

            return redirect(route('medicalFees.index'));
        }

        return view('medical_fees.edit')->with('medicalFees', $medicalFees);
    }

    /**
     * Update the specified medical_fees in storage.
     *
     * @param int $id
     * @param Updatemedical_feesRequest $request
     *
     * @return Response
     */
    public function update($id, Updatemedical_feesRequest $request)
    {
        $this->authorize('update_medicalFees');
        $medicalFees = $this->medicalFeesRepository->find($id);

        if (empty($medicalFees)) {
            Flash::error('Medical Fees not found');

            return redirect(route('medicalFees.index'));
        }

        $medicalFees = $this->medicalFeesRepository->update($request->all(), $id);

        Flash::success('Medical Fees updated successfully.');

        return redirect(route('medicalFees.index'));
    }

    /**
     * Remove the specified medical_fees from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_medicalFees');
        $medicalFees = $this->medicalFeesRepository->find($id);

        if (empty($medicalFees)) {
            Flash::error('Medical Fees not found');

            return redirect(route('medicalFees.index'));
        }

        $this->medicalFeesRepository->delete($id);

        Flash::success('Medical Fees deleted successfully.');

        return redirect(route('medicalFees.index'));
    }

    public function getFees()
    {
        $results = DB::connection('SismaSalud')->select("SELECT codigo, nombre, tipo FROM sis_manual");
        //dd($results);
        foreach ($results as $result) {
            //Se valida que el procedimiento esté registrado
            $existingFees = Medical_fees::where('honorary_code', $result->codigo)->first();
            if ($existingFees) {              
                // Actualiza los datos del procedimiento         
                $existingFees->honorary_code = $result->codigo;
                $existingFees->payment_manual = $result->nombre;
                $existingFees->fees_type = $result->tipo;
                $existingFees->save();
            }else {
                $newFees = new Medical_fees();
                $newFees->honorary_code = $result->codigo;
                $newFees->payment_manual = $result->nombre;
                $newFees->fees_type = $result->tipo;
                $newFees->save();
            }
        }
        session()->flash('success', "Honorarios actualizados correctamente!!");

        return redirect(route('medicalFees.index'));
    }
}
