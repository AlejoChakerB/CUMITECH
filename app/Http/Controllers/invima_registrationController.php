<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createinvima_registrationRequest;
use App\Http\Requests\Updateinvima_registrationRequest;
use App\Repositories\invima_registrationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Invima_registration;

class invima_registrationController extends AppBaseController
{
    /** @var invima_registrationRepository $invimaRegistrationRepository*/
    private $invimaRegistrationRepository;

    public function __construct(invima_registrationRepository $invimaRegistrationRepo)
    {
        $this->invimaRegistrationRepository = $invimaRegistrationRepo;
    }

    /**
     * Display a listing of the invima_registration.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $invimaQuery = Invima_registration::query();

        if (!empty($search)) {
            $invimaQuery->where('tradename', 'LIKE', '%' . $search . '%')
                        ->orWhere('health_register', 'LIKE', '%' . $search . '%')
                        ->orWhere('state_invima', 'LIKE', '%' . $search . '%')
                        ->orWhere('validity_registration', 'LIKE', '%' . $search . '%')
                        ->orWhere('laboratory_manufacturer', 'LIKE', '%' . $search . '%')
                        ->orWhere('pharmaceutical_form', 'LIKE', '%' . $search . '%');
        }

        $invimaRegistrations = $invimaQuery->paginate($perPage);

        return view('invima_registrations.index', compact('invimaRegistrations'));
    }

    /**
     * Show the form for creating a new invima_registration.
     *
     * @return Response
     */
    public function create()
    {
        return view('invima_registrations.create');
    }

    /**
     * Store a newly created invima_registration in storage.
     *
     * @param Createinvima_registrationRequest $request
     *
     * @return Response
     */
    public function store(Createinvima_registrationRequest $request)
    {
        $input = $request->all();

        $invimaRegistration = $this->invimaRegistrationRepository->create($input);

        session()->flash('success', "¡¡Registro invima registrado con éxito!!");

        return redirect(route('invimaRegistrations.index'));
    }

    /**
     * Display the specified invima_registration.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $invimaRegistration = $this->invimaRegistrationRepository->find($id);

        if (empty($invimaRegistration)) {
            Flash::error('Invima Registration not found');

            return redirect(route('invimaRegistrations.index'));
        }

        return view('invima_registrations.show')->with('invimaRegistration', $invimaRegistration);
    }

    /**
     * Show the form for editing the specified invima_registration.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $invimaRegistration = $this->invimaRegistrationRepository->find($id);

        if (empty($invimaRegistration)) {
            Flash::error('Invima Registration not found');

            return redirect(route('invimaRegistrations.index'));
        }

        return view('invima_registrations.edit')->with('invimaRegistration', $invimaRegistration);
    }

    /**
     * Update the specified invima_registration in storage.
     *
     * @param int $id
     * @param Updateinvima_registrationRequest $request
     *
     * @return Response
     */
    public function update($id, Updateinvima_registrationRequest $request)
    {
        $invimaRegistration = $this->invimaRegistrationRepository->find($id);

        if (empty($invimaRegistration)) {
            Flash::error('Invima Registration not found');

            return redirect(route('invimaRegistrations.index'));
        }

        $invimaRegistration = $this->invimaRegistrationRepository->update($request->all(), $id);

        session()->flash('success', "¡¡Registro invima modificado con éxito!!");

        return redirect(route('invimaRegistrations.index'));
    }

    /**
     * Remove the specified invima_registration from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $invimaRegistration = $this->invimaRegistrationRepository->find($id);

        if (empty($invimaRegistration)) {
            Flash::error('Invima Registration not found');

            return redirect(route('invimaRegistrations.index'));
        }

        $this->invimaRegistrationRepository->delete($id);

        Flash::success('Invima Registration deleted successfully.');

        return redirect(route('invimaRegistrations.index'));
    }
}
