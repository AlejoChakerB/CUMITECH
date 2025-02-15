<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateproceduresRequest;
use App\Http\Requests\UpdateproceduresRequest;
use App\Repositories\proceduresRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Procedures;
use Illuminate\Support\Facades\Log;
use Flash;
use Response;
use App\Models\SismaSalud\sis_proc;

class proceduresController extends AppBaseController
{
    /** @var proceduresRepository $proceduresRepository*/
    private $proceduresRepository;

    public function __construct(proceduresRepository $proceduresRepo)
    {
        $this->proceduresRepository = $proceduresRepo;
    }

    /**
     * Display a listing of the procedures.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_procedure');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $proceduresQuery = Procedures::query();

        if (!empty($search)) {
            $proceduresQuery->where('code', 'LIKE', '%' . $search . '%')
                    ->orWhere('manual_type', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhere('cups', 'LIKE', '%' . $search . '%')
                    ->orWhere('rips', 'LIKE', '%' . $search . '%')
                    ->orWhere('uvr', 'LIKE', '%' . $search . '%')
                    ->orWhere('uvt', 'LIKE', '%' . $search . '%')
                    ->orWhere('category', 'LIKE', '%' . $search . '%');
        }

        $procedures = $proceduresQuery->paginate($perPage);
        $total = Procedures::count();
        $ISS = Procedures::where('manual_type', '256')
        ->orWhere('manual_type', '312')
        ->count();
        $SOAT = Procedures::where('manual_type', 'SOAT')->count();
        return view('procedures.index', compact('procedures', 'total', 'ISS', 'SOAT'));
    }

    /**
     * Show the form for creating a new procedures.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_procedure');
        return view('procedures.create');
    }

    /**
     * Store a newly created procedures in storage.
     *
     * @param CreateproceduresRequest $request
     *
     * @return Response
     */
    public function store(CreateproceduresRequest $request)
    {
        $this->authorize('create_procedure');
        $input = $request->all();

        $procedures = $this->proceduresRepository->create($input);

        Flash::success('Procedures saved successfully.');

        return redirect(route('procedures.index'));
    }

    /**
     * Display the specified procedures.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('view_procedure');
        $procedures = $this->proceduresRepository->find($id);

        if (empty($procedures)) {
            Flash::error('Procedures not found');

            return redirect(route('procedures.index'));
        }

        return view('procedures.show')->with('procedures', $procedures);
    }

    /**
     * Show the form for editing the specified procedures.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_procedure');
        $procedures = $this->proceduresRepository->find($id);

        if (empty($procedures)) {
            Flash::error('Procedures not found');

            return redirect(route('procedures.index'));
        }

        return view('procedures.edit', compact('procedures'));
    }

    /**
     * Update the specified procedures in storage.
     *
     * @param int $id
     * @param UpdateproceduresRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproceduresRequest $request)
    {
        $this->authorize('update_procedure');
        $procedures = $this->proceduresRepository->find($id);

        if (empty($procedures)) {
            Flash::error('Procedures not found');

            return redirect(route('procedures.index'));
        }

        $procedures = $this->proceduresRepository->update($request->all(), $id);

        Flash::success('Procedures updated successfully.');

        return redirect(route('procedures.index'));
    }

    /**
     * Remove the specified procedures from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_procedure');
        $procedures = $this->proceduresRepository->find($id);

        if (empty($procedures)) {
            Flash::error('Procedures not found');

            return redirect(route('procedures.index'));
        }

        $this->proceduresRepository->delete($id);

        Flash::success('Procedures deleted successfully.');

        return redirect(route('procedures.index'));
    }

    public function getProcedures()
    {

        // Establecer un límite de tiempo de ejecución más largo (por ejemplo, 300 segundos)
        ini_set('max_execution_time', 300);
        $chunkSize = 1000;
        DB::transaction(function () use ($chunkSize) {
            sis_proc::where('Activo', 1)
                ->where('tipo', '!=', 'INTS')
                ->select('codigo', 'tipo', 'cups', 'nombreve', 'rips', 'uvr', 'factoruvt', 'manual_02')
                ->orderBy('codigo', 'asc')
                ->chunk($chunkSize, function ($results) {
                    foreach ($results as $result) {
                        $existingProcedures = Procedures::where('code', $result->codigo)
                        ->where('manual_type', $result->tipo)->first();
                        $uvr = $result->uvr;
                        $uvt = $result->factoruvt;
                        $value = $result->manual_02;
                        $cups = $result->cups;
                        if ($uvr === NULL) {$uvr = 0;}
                        if ($uvt === NULL) {$uvt = 0;}
                        if ($value === NULL) {$value = 0;}
                        if ($cups === NULL) {$cups = $result->codigo;}
                        if ($existingProcedures) {              
                            // Actualiza los datos del procedimiento   
                            $existingProcedures->update(
                            [
                                'code' => $result->codigo,
                                'manual_type' => $result->tipo,
                                'description' => $result->nombreve,
                                'cups' => $cups,
                                'rips' => $result->rips,
                                'uvr' => $uvr,
                                'uvt' => $uvt,
                                'value' => $value
                            ]);
                        }else {
                            Procedures::create(
                            [
                                'code' => $result->codigo,
                                'manual_type' => $result->tipo,
                                'description' => $result->nombreve,
                                'cups' => $cups,
                                'rips' => $result->rips,
                                'uvr' => $uvr,
                                'uvt' => $uvt,
                                'value' => $value
                            ]);
                        }
                    }
                });
        });
        // Restaurar el límite de tiempo de ejecución predeterminado (opcional)
        ini_set('max_execution_time', 60);
        session()->flash('success', "¡¡Procedimientos actualizados correctamente!!");

        return redirect(route('procedures.index'));
    }

    public function searchProcedures(Request $request)
    {
        Log::info($request->all());
        $term = $request->input('q');
        $page = $request->input('page', 1);
        $perPage = 30;

        $procedures = Procedures::where('code', 'like', '%' . $term . '%')
            ->orWhere('description', 'like', '%' . $term . '%')
            ->orWhere('manual_type', 'like', '%' . $term . '%')
            ->paginate($perPage, ['*'], 'page', $page);
        $results = $procedures->items();
        $totalCount = $procedures->total();

        $results = $procedures->map(function ($procedure) {
            return [
                'id' => $procedure->id,
                'text' => $procedure->description . ' (CUPS: ' . $procedure->cups . " - " . $procedure->manual_type . ')'
            ];
        });
    
        return response()->json([
            'results' => $results,
            'total_count' => $procedures->count()
        ]);
    }

    public function getsCups(Request $request)
    {
        $term = $request->input('q');
        $page = $request->input('page', 1);
        $perPage = 30;

        $procedures = Procedures::where('code', 'like', '%' . $term . '%')
            ->orWhere('description', 'like', '%' . $term . '%')
            ->orWhere('cups', 'like', '%' . $term . '%')
            ->paginate($perPage, ['*'], 'page', $page);
        $results = $procedures->items();
        $totalCount = $procedures->total();

        return response()->json([
            'results' => collect($results)->map(function ($procedure) {
                return [
                    'id' => $procedure->cups,
                    'text' => $procedure->description . ' (CUPS: ' . $procedure->cups . " - " . $procedure->manual_type .')'
                ];
            }),
            'total_count' => $totalCount
        ]);
    }

    public function getsCode(Request $request)
    {
        $term = $request->input('q');
        $page = $request->input('page', 1);
        $perPage = 30;

        $procedures = Procedures::where('code', 'like', '%' . $term . '%')
            ->orWhere('description', 'like', '%' . $term . '%')
            ->orWhere('cups', 'like', '%' . $term . '%')
            ->paginate($perPage, ['*'], 'page', $page);
        $results = $procedures->items();
        $totalCount = $procedures->total();

        return response()->json([
            'results' => collect($results)->map(function ($procedure) {
                return [
                    'id' => $procedure->code,
                    'text' => $procedure->description . ' (CUPS: ' . $procedure->cups . " - " . $procedure->manual_type .')'
                ];
            }),
            'total_count' => $totalCount
        ]);
    }

    public function getsCode2(Request $request)
    {
        $term = $request->input('q');
        $page = $request->input('page', 1);
        $perPage = 30;

        $procedures = Procedures::where('code', 'like', '%' . $term . '%')
            ->orWhere('description', 'like', '%' . $term . '%')
            ->orWhere('cups', 'like', '%' . $term . '%')
            ->paginate($perPage, ['*'], 'page', $page);
        $results = $procedures->items();
        $totalCount = $procedures->total();

        return response()->json([
            'results' => collect($results)->map(function ($procedure) {
                return [
                    'id' => $procedure->code,
                    'text' => $procedure->code
                ];
            }),
            'total_count' => $totalCount
        ]);
    }
}
