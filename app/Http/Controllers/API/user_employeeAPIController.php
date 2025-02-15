<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createuser_employeesAPIRequest;
use App\Http\Requests\API\Updateuser_employeesAPIRequest;
use App\Models\user_employees;
use App\Repositories\user_employeeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class user_employeesController
 * @package App\Http\Controllers\API
 */

class user_employeeAPIController extends AppBaseController
{
    /** @var  user_employeeRepository */
    private $userEmployeesRepository;

    public function __construct(user_employeeRepository $userEmployeesRepo)
    {
        $this->userEmployeesRepository = $userEmployeesRepo;
    }

    /**
     * Display a listing of the user_employees.
     * GET|HEAD /userEmployees
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $userEmployees = $this->userEmployeesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($userEmployees->toArray(), 'User Employees retrieved successfully');
    }

    /**
     * Store a newly created user_employees in storage.
     * POST /userEmployees
     *
     * @param Createuser_employeesAPIRequest $request
     *
     * @return Response
     */
    public function store(Createuser_employeesAPIRequest $request)
    {
        $input = $request->all();

        $userEmployees = $this->userEmployeesRepository->create($input);

        return $this->sendResponse($userEmployees->toArray(), 'User Employees saved successfully');
    }

    /**
     * Display the specified user_employees.
     * GET|HEAD /userEmployees/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var user_employees $userEmployees */
        $userEmployees = $this->userEmployeesRepository->find($id);

        if (empty($userEmployees)) {
            return $this->sendError('User Employees not found');
        }

        return $this->sendResponse($userEmployees->toArray(), 'User Employees retrieved successfully');
    }

    /**
     * Update the specified user_employees in storage.
     * PUT/PATCH /userEmployees/{id}
     *
     * @param int $id
     * @param Updateuser_employeesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateuser_employeesAPIRequest $request)
    {
        $input = $request->all();

        /** @var user_employees $userEmployees */
        $userEmployees = $this->userEmployeesRepository->find($id);

        if (empty($userEmployees)) {
            return $this->sendError('User Employees not found');
        }

        $userEmployees = $this->userEmployeesRepository->update($input, $id);

        return $this->sendResponse($userEmployees->toArray(), 'user_employees updated successfully');
    }

    /**
     * Remove the specified user_employees from storage.
     * DELETE /userEmployees/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var user_employees $userEmployees */
        $userEmployees = $this->userEmployeesRepository->find($id);

        if (empty($userEmployees)) {
            return $this->sendError('User Employees not found');
        }

        $userEmployees->delete();

        return $this->sendSuccess('User Employees deleted successfully');
    }
}
