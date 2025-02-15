<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createimaging_productionRequest;
use App\Http\Requests\Updateimaging_productionRequest;
use App\Repositories\imaging_productionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\imaging_production;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\imagingProdImport;

class imaging_productionController extends AppBaseController
{
    /** @var imaging_productionRepository $imagingProductionRepository*/
    private $imagingProductionRepository;

    public function __construct(imaging_productionRepository $imagingProductionRepo)
    {
        $this->imagingProductionRepository = $imagingProductionRepo;
    }

    /**
     * Display a listing of the imaging_production.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $imagingProductionsQuery = Imaging_production::query();

        if (!empty($search)) {
            $imagingProductionsQuery->where('id', 'LIKE', '%' . $search . '%')
            ->orWhere('cups', 'LIKE', '%' . $search . '%');
        }

        $imagingProductions = $imagingProductionsQuery->paginate($perPage);

        return view('imaging_productions.index')
            ->with('imagingProductions', $imagingProductions);
    }

    /**
     * Show the form for creating a new imaging_production.
     *
     * @return Response
     */
    public function create()
    {
        return view('imaging_productions.create');
    }

    /**
     * Store a newly created imaging_production in storage.
     *
     * @param Createimaging_productionRequest $request
     *
     * @return Response
     */
    public function store(Createimaging_productionRequest $request)
    {
        $input = $request->all();

        $imagingProduction = $this->imagingProductionRepository->create($input);

        Flash::success('Imaging Production saved successfully.');

        return redirect(route('imagingProductions.index'));
    }

    /**
     * Display the specified imaging_production.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $imagingProduction = $this->imagingProductionRepository->find($id);

        if (empty($imagingProduction)) {
            Flash::error('Imaging Production not found');

            return redirect(route('imagingProductions.index'));
        }

        return view('imaging_productions.show')->with('imagingProduction', $imagingProduction);
    }

    /**
     * Show the form for editing the specified imaging_production.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $imagingProduction = $this->imagingProductionRepository->find($id);

        if (empty($imagingProduction)) {
            Flash::error('Imaging Production not found');

            return redirect(route('imagingProductions.index'));
        }

        return view('imaging_productions.edit')->with('imagingProduction', $imagingProduction);
    }

    /**
     * Update the specified imaging_production in storage.
     *
     * @param int $id
     * @param Updateimaging_productionRequest $request
     *
     * @return Response
     */
    public function update($id, Updateimaging_productionRequest $request)
    {
        $imagingProduction = $this->imagingProductionRepository->find($id);

        if (empty($imagingProduction)) {
            Flash::error('Imaging Production not found');

            return redirect(route('imagingProductions.index'));
        }

        $imagingProduction = $this->imagingProductionRepository->update($request->all(), $id);

        Flash::success('Imaging Production updated successfully.');

        return redirect(route('imagingProductions.index'));
    }

    /**
     * Remove the specified imaging_production from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $imagingProduction = $this->imagingProductionRepository->find($id);

        if (empty($imagingProduction)) {
            Flash::error('Imaging Production not found');

            return redirect(route('imagingProductions.index'));
        }

        $this->imagingProductionRepository->delete($id);

        Flash::success('Imaging Production deleted successfully.');

        return redirect(route('imagingProductions.index'));
    }

    public function importImagingProductions(Request $request)
    {
        $file = $request->file('file');
        try {
            $import = new imagingProdImport();
            $excel = Excel::import($import, $file);
            $messages = $import->messages->toArray();
            if (empty($messages)) {
                return redirect()->back()->with('success', '¡Archivo importado correctamente!');
            } else {
                $selectMessage = implode(', ', $messages);
                return redirect()->back()->with('error', '¡Los siguientes datos no se encontraron registrados! ' .  $selectMessage);
            }
        } catch (\Exception $e) {
            // Manejar el error
            return redirect()->back()->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Importación completada');
    }
}
