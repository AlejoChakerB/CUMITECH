<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateemployeAPIRequest;
use App\Http\Requests\API\UpdateemployeAPIRequest;
use App\Models\employe;
use App\Repositories\employeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class employeController
 * @package App\Http\Controllers\API
 */

class employeAPIController extends AppBaseController
{
    /** @var  employeRepository */
    private $employeRepository;

    public function __construct(employeRepository $employeRepo)
    {
        $this->employeRepository = $employeRepo;
    }

    /**
     * Display a listing of the employe.
     * GET|HEAD /employes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $employes = employe::where('unit', '!=', 'pendiente')
        ->Where('unit', '!=', 'Deshabilitado')
        ->orderBy('name')
        ->get();

        return $this->sendResponse($employes->toArray(), 'Empleados recuperadas con éxito');
    }

    /**
     * Store a newly created employe in storage.
     * POST /employes
     *
     * @param CreateemployeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateemployeAPIRequest $request)
    {
        $input = $request->all();

        $employe = $this->employeRepository->create($input);

        return $this->sendResponse($employe->toArray(), 'Employe saved successfully');
    }

    /**
     * Display the specified employe.
     * GET|HEAD /employes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var employe $employe */
        $employe = $this->employeRepository->find($id);

        if (empty($employe)) {
            return $this->sendError('Employe not found');
        }

        return $this->sendResponse($employe->toArray(), 'Employe retrieved successfully');
    }

    /**
     * Update the specified employe in storage.
     * PUT/PATCH /employes/{id}
     *
     * @param int $id
     * @param UpdateemployeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateemployeAPIRequest $request)
    {
        $input = $request->all();

        /** @var employe $employe */
        $employe = $this->employeRepository->find($id);

        if (empty($employe)) {
            return $this->sendError('Employe not found');
        }

        $employe = $this->employeRepository->update($input, $id);

        return $this->sendResponse($employe->toArray(), '¡¡Empleado modificado exitosamente!!');
    }

    /**
     * Remove the specified employe from storage.
     * DELETE /employes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var employe $employe */
        $employe = $this->employeRepository->find($id);

        if (empty($employe)) {
            return $this->sendError('Employe not found');
        }

        $employe->delete();

        return $this->sendSuccess('Employe deleted successfully');
    }
}
