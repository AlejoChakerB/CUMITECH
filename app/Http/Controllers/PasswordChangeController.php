<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    public function showChangeForm()
    {
        return view('auth.passwords.change');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->password_changed = true;
        $user->save();

        return redirect()->route('home')->with('success', 'Contraseña cambiada exitosamente.');
    }
}