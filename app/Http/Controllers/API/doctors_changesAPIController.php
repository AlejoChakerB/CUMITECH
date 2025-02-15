<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createdoctors_changesAPIRequest;
use App\Http\Requests\API\Updatedoctors_changesAPIRequest;
use App\Models\doctors_changes;
use App\Repositories\doctors_changesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class doctors_changesController
 * @package App\Http\Controllers\API
 */

class doctors_changesAPIController extends AppBaseController
{
    /** @var  doctors_changesRepository */
    private $doctorsChangesRepository;

    public function __construct(doctors_changesRepository $doctorsChangesRepo)
    {
        $this->doctorsChangesRepository = $doctorsChangesRepo;
    }

    /**
     * Display a listing of the doctors_changes.
     * GET|HEAD /doctorsChanges
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $doctorsChanges = $this->doctorsChangesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($doctorsChanges->toArray(), 'Doctors Changes retrieved successfully');
    }

    /**
     * Store a newly created doctors_changes in storage.
     * POST /doctorsChanges
     *
     * @param Createdoctors_changesAPIRequest $request
     *
     * @return Response
     */
    public function store(Createdoctors_changesAPIRequest $request)
    {
        $input = $request->all();

        $doctorsChanges = $this->doctorsChangesRepository->create($input);

        return $this->sendResponse($doctorsChanges->toArray(), 'Doctors Changes saved successfully');
    }

    /**
     * Display the specified doctors_changes.
     * GET|HEAD /doctorsChanges/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var doctors_changes $doctorsChanges */
        $doctorsChanges = $this->doctorsChangesRepository->find($id);

        if (empty($doctorsChanges)) {
            return $this->sendError('Doctors Changes not found');
        }

        return $this->sendResponse($doctorsChanges->toArray(), 'Doctors Changes retrieved successfully');
    }

    /**
     * Update the specified doctors_changes in storage.
     * PUT/PATCH /doctorsChanges/{id}
     *
     * @param int $id
     * @param Updatedoctors_changesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatedoctors_changesAPIRequest $request)
    {
        $input = $request->all();

        /** @var doctors_changes $doctorsChanges */
        $doctorsChanges = $this->doctorsChangesRepository->find($id);

        if (empty($doctorsChanges)) {
            return $this->sendError('Doctors Changes not found');
        }

        $doctorsChanges = $this->doctorsChangesRepository->update($input, $id);

        return $this->sendResponse($doctorsChanges->toArray(), 'doctors_changes updated successfully');
    }

    /**
     * Remove the specified doctors_changes from storage.
     * DELETE /doctorsChanges/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var doctors_changes $doctorsChanges */
        $doctorsChanges = $this->doctorsChangesRepository->find($id);

        if (empty($doctorsChanges)) {
            return $this->sendError('Doctors Changes not found');
        }

        $doctorsChanges->delete();

        return $this->sendSuccess('Doctors Changes deleted successfully');
    }
}
