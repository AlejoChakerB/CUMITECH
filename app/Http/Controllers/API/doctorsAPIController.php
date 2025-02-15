<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatedoctorsAPIRequest;
use App\Http\Requests\API\UpdatedoctorsAPIRequest;
use App\Models\doctors;
use App\Repositories\doctorsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class doctorsController
 * @package App\Http\Controllers\API
 */

class doctorsAPIController extends AppBaseController
{
    /** @var  doctorsRepository */
    private $doctorsRepository;

    public function __construct(doctorsRepository $doctorsRepo)
    {
        $this->doctorsRepository = $doctorsRepo;
    }

    /**
     * Display a listing of the doctors.
     * GET|HEAD /doctors
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $doctors = $this->doctorsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($doctors->toArray(), 'Doctors retrieved successfully');
    }

    /**
     * Store a newly created doctors in storage.
     * POST /doctors
     *
     * @param CreatedoctorsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatedoctorsAPIRequest $request)
    {
        $input = $request->all();

        $doctors = $this->doctorsRepository->create($input);

        return $this->sendResponse($doctors->toArray(), 'Doctors saved successfully');
    }

    /**
     * Display the specified doctors.
     * GET|HEAD /doctors/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var doctors $doctors */
        $doctors = $this->doctorsRepository->find($id);

        if (empty($doctors)) {
            return $this->sendError('Doctors not found');
        }

        return $this->sendResponse($doctors->toArray(), 'Doctors retrieved successfully');
    }

    /**
     * Update the specified doctors in storage.
     * PUT/PATCH /doctors/{id}
     *
     * @param int $id
     * @param UpdatedoctorsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedoctorsAPIRequest $request)
    {
        $input = $request->all();

        /** @var doctors $doctors */
        $doctors = $this->doctorsRepository->find($id);

        if (empty($doctors)) {
            return $this->sendError('Doctors not found');
        }

        $doctors = $this->doctorsRepository->update($input, $id);

        return $this->sendResponse($doctors->toArray(), 'doctors updated successfully');
    }

    /**
     * Remove the specified doctors from storage.
     * DELETE /doctors/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var doctors $doctors */
        $doctors = $this->doctorsRepository->find($id);

        if (empty($doctors)) {
            return $this->sendError('Doctors not found');
        }

        $doctors->delete();

        return $this->sendSuccess('Doctors deleted successfully');
    }
}
