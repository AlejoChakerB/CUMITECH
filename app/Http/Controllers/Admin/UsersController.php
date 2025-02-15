<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UsersRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $usersRepository;
    
    public function __construct(UsersRepository $usersRepo)
    {
        $this->usersRepository = $usersRepo;
    }

    public function index(Request $request)
    {
        $this->authorize('view_user');
        $users = $this->usersRepository->all();

        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;

        $this->authorize('create_user');

        $roles = Role::with('permissions')->get();
        $permissions = Permission::select(['id', 'name', 'display_name'])->get();

        return view('admin.users.create', compact('user', 'roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $this->authorize('create_user');
        $input = $request->only('name', 'email')
                    + [
                        'password' => bcrypt($request->input('password')),
                    ];

        $user = User::create($input);

        if($request->filled('roles'))
        {
            $user->assignRole($request->roles);
        }        
        if ($request->filled('permissions'))
        {
            $user->givePermissionTo($request->permissions);
        }
        $name = $request->name;
        session()->flash('success', "¡¡El usuario $name se ha creado con éxito!!");
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('show_user');

        $roles = Role::with('permissions')->get();
        $permissions = Permission::select(['id', 'name', 'display_name'])->get();

        return view('admin.users.show', compact('user', 'roles', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update_user');
        
        $roles = Role::with('permissions')->get();
        $permissions = Permission::select(['id', 'name', 'display_name'])->get();

        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update_user');
        $data = $request->only('name', 'email', 'is_active');
        $password = $request->input('password');
        $name = $request->name;
        if($password)
        {
            $data['password'] = bcrypt($password);
        }

        $user->update($data);

        session()->flash('success', "¡¡El usuario $name se ha modificado con éxito!!");

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy_user');
        $name = $user->name;
        $user->delete();

        session()->flash('success', "¡¡El usuario $name se ha eliminado con éxito!!");

        return redirect()->route('admin.users.index');
    }
}
