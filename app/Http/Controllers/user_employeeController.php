<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createuser_employeeRequest;
use App\Http\Requests\Updateuser_employeeRequest;
use App\Repositories\user_employeeRepository;
use App\Http\Controllers\AppBaseController;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\employe;
use App\Models\user_employee;
use Flash;
use Response;

class user_employeeController extends AppBaseController
{
    /** @var user_employeeRepository $userEmployeesRepository*/
    private $userEmployeesRepository;

    public function __construct(user_employeeRepository $userEmployeesRepo)
    {
        $this->userEmployeesRepository = $userEmployeesRepo;
    }

    /**
     * Display a listing of the user_employees.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_userEmployees');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $userEmployeesQuery = user_employee::query();

        if (!empty($search)) {
            $userEmployees->where('id_employees', 'LIKE', '%' . $search . '%');
        }

        $userEmployees = $userEmployeesQuery->orderBy('id', 'DESC')->paginate($perPage);
        return view('user_employees.index', compact('userEmployees'));
    }

    /**
     * Show the form for creating a new user_employees.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_userEmployees');
        $users = User::orderBy('name')->pluck('name', 'id');
        $employees = Employe::orderBy('name')->pluck('name', 'id');
        return view('user_employees.create', compact('users', 'employees'));
    }

    /**
     * Store a newly created user_employees in storage.
     *
     * @param Createuser_employeeRequest $request
     *
     * @return Response
     */
    public function store(Createuser_employeeRequest $request)
    {
        $input = $request->all();
        $userEmployees = $this->userEmployeesRepository->create($input);
        
        Flash::success('User Employees saved successfully.');

        return redirect(route('userEmployees.index'));
    }

    /**
     * Display the specified user_employees.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_userEmployees');
        $userEmployees = $this->userEmployeesRepository->find($id);

        if (empty($userEmployees)) {
            Flash::error('User Employees not found');

            return redirect(route('userEmployees.index'));
        }

        return view('user_employees.show')->with('userEmployees', $userEmployees);
    }

    /**
     * Show the form for editing the specified user_employees.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_userEmployees');
        $userEmployees = $this->userEmployeesRepository->find($id);

        if (empty($userEmployees)) {
            Flash::error('User Employees not found');

            return redirect(route('userEmployees.index'));
        }

        return view('user_employees.edit')->with('userEmployees', $userEmployees);
    }

    /**
     * Update the specified user_employees in storage.
     *
     * @param int $id
     * @param Updateuser_employeeRequest $request
     *
     * @return Response
     */
    public function update($id, Updateuser_employeeRequest $request)
    {
        $userEmployees = $this->userEmployeesRepository->find($id);

        if (empty($userEmployees)) {
            Flash::error('User Employees not found');

            return redirect(route('userEmployees.index'));
        }

        $userEmployees = $this->userEmployeesRepository->update($request->all(), $id);

        Flash::success('User Employees updated successfully.');

        return redirect(route('userEmployees.index'));
    }

    /**
     * Remove the specified user_employees from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_userEmployees');
        $userEmployees = $this->userEmployeesRepository->find($id);

        if (empty($userEmployees)) {
            Flash::error('User Employees not found');

            return redirect(route('userEmployees.index'));
        }

        $this->userEmployeesRepository->delete($id);

        Flash::success('User Employees deleted successfully.');

        return redirect(route('userEmployees.index'));
    }

    public function createUsers()
    {
        ini_set('max_execution_time', 1800);
        $employees = Employe::where('unit', '!=', 'Deshabilitado')->get();
        foreach ($employees as $employee) 
        {
            $user = User::where('email', $employee->dni)
            ->first();
            if ($user) {       
                $validation = $this->validation($user, $employee);
                if ($validation == 'false') {
                    $user->update([
                        'name' => $employee->name,
                        'email' => $employee->dni,
                        'password' => Hash::make($employee->dni),
                        'password_changed' => '1'
                    ]);
                    $this->createRelation($employee->dni, $employee->id);
                }
            }else {
                $user = User::create([
                    'name' => $employee->name,
                    'email' => $employee->dni,
                    'password' => Hash::make($employee->dni),
                    'password_changed' => '1'
                ]);
                $role = Role::where('name', 'viewer_stand')->first();
                $user->assignRole($role);
                $this->createRelation($employee->dni, $employee->id);
                
            }
        }
        ini_restore('max_execution_time');
        return redirect(route('userEmployees.index'));
    }

    public function validation($user, $employee){
        $validation = 'false';
        //dd($user, $employee);
        if ($employee->name == $user->name && $employee->dni == $user->email) {
            $validation == 'true';
        }
        return $validation;
    }

    public function createRelation($userEmail, $employeeId)
    {
        $user = User::where('email', $userEmail)
        ->first();

        $userEmployee = User_employee::where('id_user', $user->id)
        ->where('id_employees', $employeeId)
        ->first();

        $userEmployee_data = [
            'id_user' => $user->id,
            'id_employees' => $employeeId
        ];
        if ($userEmployee) {
            $userEmployee->update($userEmployee_data);
        }else {
            User_employee::create($userEmployee_data);
        }
        $this->getUserEmployee_sqlsrv($user->id, $employeeId);
    }

    public function getUserEmployee_sqlsrv($userid, $employeeId)
    {
        $result = User_employee::where('id_user', $userid)
        ->where('id_employees', $employeeId)
        ->first();

        if ($result) {
            $existing_sqlrv = \App\Models\CumiSystem_SQLSRV\user_employee::where('id_user', $userid)
            ->where('id_employees', $employeeId)
            ->first();
            //dd($dni_employe, $existing_sqlrv);
            $userEmployee_data = [
                'id_user' => $result->id_user,
                'id_employees' => $result->id_employees
            ];
            
            if ($existing_sqlrv) {
                $existing_sqlrv->update($userEmployee_data);
            } else {
                DB::connection('cumisystem_sqlsrv')->unprepared('SET IDENTITY_INSERT user_employees ON');
                $userEmployee_data['id'] = $result->id;

                // Crear un nuevo registro
                \App\Models\CumiSystem_SQLSRV\user_employee::create($userEmployee_data);

                // Desactivar IDENTITY_INSERT después de la inserción
                DB::connection('cumisystem_sqlsrv')->unprepared('SET IDENTITY_INSERT user_employees OFF');
            }
        }
    }
}
