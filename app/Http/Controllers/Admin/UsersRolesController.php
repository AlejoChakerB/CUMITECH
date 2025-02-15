<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersRolesController extends Controller
{
    public function update(Request $request, User $user)
    {
        $user->roles()->detach();

        if ($request->filled('roles'))
        {
            $user->assignRole($request->roles);
        }

        session()->flash('success', 'Los roles han sido actualizados');
        return back();
    }
}
