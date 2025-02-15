<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createambulance_costRequest;
use App\Http\Requests\Updateambulance_costRequest;
use App\Repositories\ambulance_costRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AmbulanceImport;
use App\Models\ambulance_cost;

class ambulance_costController extends AppBaseController
{
    /** @var ambulance_costRepository $ambulanceCostRepository*/
    private $ambulanceCostRepository;

    public function __construct(ambulance_costRepository $ambulanceCostRepo)
    {
        $this->ambulanceCostRepository = $ambulanceCostRepo;
    }

    /**
     * Display a listing of the ambulance_cost.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_ambulanceCosts');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $ambulanceCostsQuery = ambulance_cost::query();

        if (!empty($search)) {
            $ambulanceCostsQuery->where('cups', 'LIKE', '%' . $search . '%')
            ->orWhere('name', 'LIKE', '%' . $search . '%');
        }

        $ambulanceCosts = $ambulanceCostsQuery->paginate($perPage);

        return view('ambulance_costs.index')
            ->with('ambulanceCosts', $ambulanceCosts);
    }

    /**
     * Show the form for creating a new ambulance_cost.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_ambulanceCosts');
        return view('ambulance_costs.create');
    }

    /**
     * Store a newly created ambulance_cost in storage.
     *
     * @param Createambulance_costRequest $request
     *
     * @return Response
     */
    public function store(Createambulance_costRequest $request)
    {
        $input = $request->all();

        $ambulanceCost = $this->ambulanceCostRepository->create($input);

        Flash::success('Ambulance Cost saved successfully.');

        return redirect(route('ambulanceCosts.index'));
    }

    /**
     * Display the specified ambulance_cost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_ambulanceCosts');
        $ambulanceCost = $this->ambulanceCostRepository->find($id);

        if (empty($ambulanceCost)) {
            Flash::error('Ambulance Cost not found');

            return redirect(route('ambulanceCosts.index'));
        }

        return view('ambulance_costs.show')->with('ambulanceCost', $ambulanceCost);
    }

    /**
     * Show the form for editing the specified ambulance_cost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_ambulanceCosts');
        $ambulanceCost = $this->ambulanceCostRepository->find($id);

        if (empty($ambulanceCost)) {
            Flash::error('Ambulance Cost not found');

            return redirect(route('ambulanceCosts.index'));
        }

        return view('ambulance_costs.edit')->with('ambulanceCost', $ambulanceCost);
    }

    /**
     * Update the specified ambulance_cost in storage.
     *
     * @param int $id
     * @param Updateambulance_costRequest $request
     *
     * @return Response
     */
    public function update($id, Updateambulance_costRequest $request)
    {
        $ambulanceCost = $this->ambulanceCostRepository->find($id);
        if (empty($ambulanceCost)) {
            Flash::error('Ambulance Cost not found');

            return redirect(route('ambulanceCosts.index'));
        }

        $ambulanceCost = $this->ambulanceCostRepository->update($request->all(), $id);

        Flash::success('Ambulance Cost updated successfully.');

        return redirect(route('ambulanceCosts.index'));
    }

    /**
     * Remove the specified ambulance_cost from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_ambulanceCosts');
        $ambulanceCost = $this->ambulanceCostRepository->find($id);

        if (empty($ambulanceCost)) {
            Flash::error('Ambulance Cost not found');

            return redirect(route('ambulanceCosts.index'));
        }

        $this->ambulanceCostRepository->delete($id);

        Flash::success('Ambulance Cost deleted successfully.');

        return redirect(route('ambulanceCosts.index'));
    }

    public function importAmbulance(Request $request)
    {
        $this->authorize('create_ambulanceCosts');
        $file = $request->file('file');
        try {
            $import = new ambulanceImport();
            Excel::import($import, $file);

            return redirect()->back()->with('success', '¡Archivo importado correctamente!');
        } catch (\Exception $e) {
            // Manejar el error
            return redirect()->back()->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Importación completada');
    }

    public function downloadAmbulance()
    {
        $filePath = public_path('Templates/Servicio_ambulancia.xlsx');
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="Servicio_ambulancia.xlsx"',
        ];

        return Response::download($filePath, 'Servicio_ambulancia.xlsx', $headers);
    }
}
