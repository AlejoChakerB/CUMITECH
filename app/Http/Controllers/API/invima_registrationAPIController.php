<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createinvima_registrationAPIRequest;
use App\Http\Requests\API\Updateinvima_registrationAPIRequest;
use App\Models\invima_registration;
use App\Repositories\invima_registrationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class invima_registrationController
 * @package App\Http\Controllers\API
 */

class invima_registrationAPIController extends AppBaseController
{
    /** @var  invima_registrationRepository */
    private $invimaRegistrationRepository;

    public function __construct(invima_registrationRepository $invimaRegistrationRepo)
    {
        $this->invimaRegistrationRepository = $invimaRegistrationRepo;
    }

    /**
     * Display a listing of the invima_registration.
     * GET|HEAD /invimaRegistrations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $invimaRegistrations = $this->invimaRegistrationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($invimaRegistrations->toArray(), 'Invima Registrations retrieved successfully');
    }

    /**
     * Store a newly created invima_registration in storage.
     * POST /invimaRegistrations
     *
     * @param Createinvima_registrationAPIRequest $request
     *
     * @return Response
     */
    public function store(Createinvima_registrationAPIRequest $request)
    {
        $input = $request->all();

        $invimaRegistration = $this->invimaRegistrationRepository->create($input);

        return $this->sendResponse($invimaRegistration->toArray(), 'Invima Registration saved successfully');
    }

    /**
     * Display the specified invima_registration.
     * GET|HEAD /invimaRegistrations/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var invima_registration $invimaRegistration */
        $invimaRegistration = $this->invimaRegistrationRepository->find($id);

        if (empty($invimaRegistration)) {
            return $this->sendError('Invima Registration not found');
        }

        return $this->sendResponse($invimaRegistration->toArray(), 'Invima Registration retrieved successfully');
    }

    /**
     * Update the specified invima_registration in storage.
     * PUT/PATCH /invimaRegistrations/{id}
     *
     * @param int $id
     * @param Updateinvima_registrationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateinvima_registrationAPIRequest $request)
    {
        $input = $request->all();

        /** @var invima_registration $invimaRegistration */
        $invimaRegistration = $this->invimaRegistrationRepository->find($id);

        if (empty($invimaRegistration)) {
            return $this->sendError('Invima Registration not found');
        }

        $invimaRegistration = $this->invimaRegistrationRepository->update($input, $id);

        return $this->sendResponse($invimaRegistration->toArray(), 'invima_registration updated successfully');
    }

    /**
     * Remove the specified invima_registration from storage.
     * DELETE /invimaRegistrations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var invima_registration $invimaRegistration */
        $invimaRegistration = $this->invimaRegistrationRepository->find($id);

        if (empty($invimaRegistration)) {
            return $this->sendError('Invima Registration not found');
        }

        $invimaRegistration->delete();

        return $this->sendSuccess('Invima Registration deleted successfully');
    }
}
