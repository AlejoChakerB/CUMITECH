<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createdoctors_changesRequest;
use App\Http\Requests\Updatedoctors_changesRequest;
use App\Repositories\doctors_changesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class doctors_changesController extends AppBaseController
{
    /** @var doctors_changesRepository $doctorsChangesRepository*/
    private $doctorsChangesRepository;

    public function __construct(doctors_changesRepository $doctorsChangesRepo)
    {
        $this->doctorsChangesRepository = $doctorsChangesRepo;
    }

    /**
     * Display a listing of the doctors_changes.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $doctorsChanges = $this->doctorsChangesRepository->all();

        return view('doctors_changes.index')
            ->with('doctorsChanges', $doctorsChanges);
    }

    /**
     * Show the form for creating a new doctors_changes.
     *
     * @return Response
     */
    public function create()
    {
        return view('doctors_changes.create');
    }

    /**
     * Store a newly created doctors_changes in storage.
     *
     * @param Createdoctors_changesRequest $request
     *
     * @return Response
     */
    public function store(Createdoctors_changesRequest $request)
    {
        $input = $request->all();

        $doctorsChanges = $this->doctorsChangesRepository->create($input);

        Flash::success('Doctors Changes saved successfully.');

        return redirect(route('doctorsChanges.index'));
    }

    /**
     * Display the specified doctors_changes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $doctorsChanges = $this->doctorsChangesRepository->find($id);

        if (empty($doctorsChanges)) {
            Flash::error('Doctors Changes not found');

            return redirect(route('doctorsChanges.index'));
        }

        return view('doctors_changes.show')->with('doctorsChanges', $doctorsChanges);
    }

    /**
     * Show the form for editing the specified doctors_changes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $doctorsChanges = $this->doctorsChangesRepository->find($id);

        if (empty($doctorsChanges)) {
            Flash::error('Doctors Changes not found');

            return redirect(route('doctorsChanges.index'));
        }

        return view('doctors_changes.edit')->with('doctorsChanges', $doctorsChanges);
    }

    /**
     * Update the specified doctors_changes in storage.
     *
     * @param int $id
     * @param Updatedoctors_changesRequest $request
     *
     * @return Response
     */
    public function update($id, Updatedoctors_changesRequest $request)
    {
        $doctorsChanges = $this->doctorsChangesRepository->find($id);

        if (empty($doctorsChanges)) {
            Flash::error('Doctors Changes not found');

            return redirect(route('doctorsChanges.index'));
        }

        $doctorsChanges = $this->doctorsChangesRepository->update($request->all(), $id);

        Flash::success('Doctors Changes updated successfully.');

        return redirect(route('doctorsChanges.index'));
    }

    /**
     * Remove the specified doctors_changes from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $doctorsChanges = $this->doctorsChangesRepository->find($id);

        if (empty($doctorsChanges)) {
            Flash::error('Doctors Changes not found');

            return redirect(route('doctorsChanges.index'));
        }

        $this->doctorsChangesRepository->delete($id);

        Flash::success('Doctors Changes deleted successfully.');

        return redirect(route('doctorsChanges.index'));
    }
}
