<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepatologyRequest;
use App\Http\Requests\UpdatepatologyRequest;
use App\Repositories\patologyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\patologyImport;

class patologyController extends AppBaseController
{
    /** @var patologyRepository $patologyRepository*/
    private $patologyRepository;

    public function __construct(patologyRepository $patologyRepo)
    {
        $this->patologyRepository = $patologyRepo;
    }

    /**
     * Display a listing of the patology.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_patologies');
        $patologies = $this->patologyRepository->all();

        return view('patologies.index')
            ->with('patologies', $patologies);
    }

    /**
     * Show the form for creating a new patology.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_patologies');
        return view('patologies.create');
    }

    /**
     * Store a newly created patology in storage.
     *
     * @param CreatepatologyRequest $request
     *
     * @return Response
     */
    public function store(CreatepatologyRequest $request)
    {
        $input = $request->all();

        $patology = $this->patologyRepository->create($input);

        Flash::success('Patology saved successfully.');

        return redirect(route('patologies.index'));
    }

    /**
     * Display the specified patology.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_patologies');
        $patology = $this->patologyRepository->find($id);

        if (empty($patology)) {
            Flash::error('Patology not found');

            return redirect(route('patologies.index'));
        }

        return view('patologies.show')->with('patology', $patology);
    }

    /**
     * Show the form for editing the specified patology.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_patologies');
        $patology = $this->patologyRepository->find($id);

        if (empty($patology)) {
            Flash::error('Patology not found');

            return redirect(route('patologies.index'));
        }

        return view('patologies.edit')->with('patology', $patology);
    }

    /**
     * Update the specified patology in storage.
     *
     * @param int $id
     * @param UpdatepatologyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepatologyRequest $request)
    {
        $patology = $this->patologyRepository->find($id);

        if (empty($patology)) {
            Flash::error('Patology not found');

            return redirect(route('patologies.index'));
        }

        $patology = $this->patologyRepository->update($request->all(), $id);

        Flash::success('Patology updated successfully.');

        return redirect(route('patologies.index'));
    }

    /**
     * Remove the specified patology from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_patologies');
        $patology = $this->patologyRepository->find($id);

        if (empty($patology)) {
            Flash::error('Patology not found');

            return redirect(route('patologies.index'));
        }

        $this->patologyRepository->delete($id);

        Flash::success('Patology deleted successfully.');

        return redirect(route('patologies.index'));
    }

    public function importPatology(Request $request){
        $this->authorize('import_patologies');
        $file = $request->file('file');
        try {
            $import = new patologyImport();
            Excel::import($import, $file);

            return redirect()->back()->with('success', '¡Archivo importado correctamente!');
        } catch (\Exception $e) {
            // Manejar el error
            return redirect()->back()->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Importación completada');
    }

    public function downloadPatologies()
    {
        $filePath = public_path('Templates/Patologias.xlsx');
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="Patologias.xlsx"',
        ];

        return Response::download($filePath, 'Patologias.xlsx', $headers);
    }
}
