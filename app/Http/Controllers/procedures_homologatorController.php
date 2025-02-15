<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createprocedures_homologatorRequest;
use App\Http\Requests\Updateprocedures_homologatorRequest;
use App\Repositories\procedures_homologatorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\procedures_homologator;

class procedures_homologatorController extends AppBaseController
{
    /** @var procedures_homologatorRepository $proceduresHomologatorRepository*/
    private $proceduresHomologatorRepository;

    public function __construct(procedures_homologatorRepository $proceduresHomologatorRepo)
    {
        $this->proceduresHomologatorRepository = $proceduresHomologatorRepo;
    }

    /**
     * Display a listing of the procedures_homologator.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $proceduresHomologatorsQuery = procedures_homologator::query();

        if (!empty($search)) {
            $proceduresHomologatorsQuery->where('cups', 'LIKE', '%' . $search . '%')
                    ->orWhere('cups_soat', 'LIKE', '%' . $search . '%')
                    ->orWhere('description_soat', 'LIKE', '%' . $search . '%')
                    ->orWhere('cups_iss', 'LIKE', '%' . $search . '%')
                    ->orWhere('description_iss', 'LIKE', '%' . $search . '%');
        }

        $proceduresHomologators = $proceduresHomologatorsQuery->paginate($perPage);

        return view('procedures_homologators.index')
            ->with('proceduresHomologators', $proceduresHomologators);
    }

    /**
     * Show the form for creating a new procedures_homologator.
     *
     * @return Response
     */
    public function create()
    {
        return view('procedures_homologators.create');
    }

    /**
     * Store a newly created procedures_homologator in storage.
     *
     * @param Createprocedures_homologatorRequest $request
     *
     * @return Response
     */
    public function store(Createprocedures_homologatorRequest $request)
    {
        $input = $request->all();

        $proceduresHomologator = $this->proceduresHomologatorRepository->create($input);

        Flash::success('Procedures Homologator saved successfully.');

        return redirect(route('proceduresHomologators.index'));
    }

    /**
     * Display the specified procedures_homologator.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $proceduresHomologator = $this->proceduresHomologatorRepository->find($id);

        if (empty($proceduresHomologator)) {
            Flash::error('Procedures Homologator not found');

            return redirect(route('proceduresHomologators.index'));
        }

        return view('procedures_homologators.show')->with('proceduresHomologator', $proceduresHomologator);
    }

    /**
     * Show the form for editing the specified procedures_homologator.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $proceduresHomologator = $this->proceduresHomologatorRepository->find($id);

        if (empty($proceduresHomologator)) {
            Flash::error('Procedures Homologator not found');

            return redirect(route('proceduresHomologators.index'));
        }

        return view('procedures_homologators.edit')->with('proceduresHomologator', $proceduresHomologator);
    }

    /**
     * Update the specified procedures_homologator in storage.
     *
     * @param int $id
     * @param Updateprocedures_homologatorRequest $request
     *
     * @return Response
     */
    public function update($id, Updateprocedures_homologatorRequest $request)
    {
        $proceduresHomologator = $this->proceduresHomologatorRepository->find($id);

        if (empty($proceduresHomologator)) {
            Flash::error('Procedures Homologator not found');

            return redirect(route('proceduresHomologators.index'));
        }

        $proceduresHomologator = $this->proceduresHomologatorRepository->update($request->all(), $id);

        Flash::success('Procedures Homologator updated successfully.');

        return redirect(route('proceduresHomologators.index'));
    }

    /**
     * Remove the specified procedures_homologator from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $proceduresHomologator = $this->proceduresHomologatorRepository->find($id);

        if (empty($proceduresHomologator)) {
            Flash::error('Procedures Homologator not found');

            return redirect(route('proceduresHomologators.index'));
        }

        $this->proceduresHomologatorRepository->delete($id);

        Flash::success('Procedures Homologator deleted successfully.');

        return redirect(route('proceduresHomologators.index'));
    }
}
