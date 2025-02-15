<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createmsurgery_procedureRequest;
use App\Http\Requests\Updatemsurgery_procedureRequest;
use App\Repositories\msurgery_procedureRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\msurgery_procedure;
use App\Models\procedures;
use App\Models\surgery;

class msurgery_procedureController extends AppBaseController
{
    /** @var msurgery_procedureRepository $msurgeryProcedureRepository*/
    private $msurgeryProcedureRepository;

    public function __construct(msurgery_procedureRepository $msurgeryProcedureRepo)
    {
        $this->msurgeryProcedureRepository = $msurgeryProcedureRepo;
    }

    /**
     * Display a listing of the msurgery_procedure.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_surgeries');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $surgeriesQuery = Surgery::query();

        if (!empty($search)) {
            $surgeriesQuery->where('cod_surgical_act', 'LIKE', '%' . $search . '%');
        }

        $surgeries = $surgeriesQuery->orderBy('date_surgery', 'DESC')->paginate($perPage);

        return view('msurgery_procedures.index', compact('surgeries'));
    }

    /**
     * Show the form for creating a new msurgery_procedure.
     *
     * @return Response
     */
    public function create()
    {
        $surgeries = Surgery::orderby('cod_surgical_act')->pluck('cod_surgical_act', 'cod_surgical_act');
        return view('msurgery_procedures.create', compact('surgeries'));
    }

    /**
     * Store a newly created msurgery_procedure in storage.
     *
     * @param Createmsurgery_procedureRequest $request
     *
     * @return Response
     */
    public function store(Createmsurgery_procedureRequest $request)
    {
        $input = $request->all();

        $msurgeryProcedure = $this->msurgeryProcedureRepository->create($input);

        Flash::success('Msurgery Procedure saved successfully.');

        return redirect(route('msurgeryProcedures.index'));
    }

    /**
     * Display the specified msurgery_procedure.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $msurgeryProcedure = $this->msurgeryProcedureRepository->find($id);

        if (empty($msurgeryProcedure)) {
            Flash::error('Msurgery Procedure not found');

            return redirect(route('msurgeryProcedures.index'));
        }

        return view('msurgery_procedures.show')->with('msurgeryProcedure', $msurgeryProcedure);
    }

    public function showProcedure($id)
    {
        $msurgeryProcedures = msurgery_procedure::where('cod_surgical_act', $id)->get();

        return view('msurgery_procedures.procedure_show', compact('msurgeryProcedures'));
    }

    public function ProcedureNotFound()
    {
        $msurgeryProcedures = msurgery_procedure::join('procedures', 'procedures.id', '=', 'msurgery_procedures.code_procedure')
        ->Where('procedures.manual_type', 'INF')
        ->select('msurgery_procedures.*')
        ->get();

        return view('msurgery_procedures.notFound', compact('msurgeryProcedures'));
    }

    /**
     * Show the form for editing the specified msurgery_procedure.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $msurgeryProcedure = $this->msurgeryProcedureRepository->find($id);
        $surgeries = Surgery::orderby('cod_surgical_act')->pluck('cod_surgical_act', 'cod_surgical_act');
        $procedure = Procedures::find($msurgeryProcedure->code_procedure);
        $proc = collect([$procedure])->map(function ($procedure) {
            return [
                $procedure->id => $procedure->description . ' (CUPS: ' . $procedure->cups . " - " . $procedure->manual_type . ')'
            ];
        })->first();

        if (empty($msurgeryProcedure)) {
            Flash::error('Msurgery Procedure not found');

            return redirect(route('msurgeryProcedures.index'));
        }

        return view('msurgery_procedures.edit', compact('msurgeryProcedure', 'proc', 'surgeries'));
    }

    /**
     * Update the specified msurgery_procedure in storage.
     *
     * @param int $id
     * @param Updatemsurgery_procedureRequest $request
     *
     * @return Response
     */
    public function update($id, Updatemsurgery_procedureRequest $request)
    {
        $msurgeryProcedure = $this->msurgeryProcedureRepository->find($id);

        if (empty($msurgeryProcedure)) {
            Flash::error('Msurgery Procedure not found');

            return redirect(route('msurgeryProcedures.index'));
        }

        $msurgeryProcedure = $this->msurgeryProcedureRepository->update($request->all(), $id);

        Flash::success('Msurgery Procedure updated successfully.');

        return redirect(route('msurgeryProcedures.index'));
    }

    /**
     * Remove the specified msurgery_procedure from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $msurgeryProcedure = $this->msurgeryProcedureRepository->find($id);

        if (empty($msurgeryProcedure)) {
            Flash::error('Msurgery Procedure not found');

            return redirect(route('msurgeryProcedures.index'));
        }

        $this->msurgeryProcedureRepository->delete($id);

        Flash::success('Msurgery Procedure deleted successfully.');

        return redirect(route('msurgeryProcedures.index'));
    }

}
