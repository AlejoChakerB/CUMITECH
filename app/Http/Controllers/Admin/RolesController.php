<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveRoleRequest;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('roles');

        return view('admin.roles.index', [
            'roles' => Role::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Role $role)
    {
        $this->authorize('roles');

        return view('admin.roles.create', [
            'role' => $role,
            'permissions' => Permission::pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRoleRequest $request)
    {
        $this->authorize('roles');

        $role = Role::create($request->validated());

        if ($request->has('permissions'))
        {
            $role->givePermissionTo($request->permissions);
        }
        session()->Flash('El role fue creado correctamente');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('roles');

        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::select(['id', 'name', 'display_name'])->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveRoleRequest $request, Role $role)
    {
        $this->authorize('roles');

        $role->update($request->validated());

        $role->permissions()->detach();

        if ($request->has('permissions'))
        {
            $role->givePermissionTo($request->permissions);
        }

        session()->Flash('El role fue actualizado correctamente');
        return redirect()->route('admin.roles.edit', $role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('roles');

        $role->delete();

        session()->Flash('El role fue eliminado');
        return redirect()->route('admin.roles.index');
    }
}
