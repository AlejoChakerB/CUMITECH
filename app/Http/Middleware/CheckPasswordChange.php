<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPasswordChange
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && !auth()->user()->password_changed) {
            return redirect()->route('password.change');
        }

        return $next($request);
    }
}