<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    public function handle($request, \Closure $next, ...$guards)
    {
        // Primero ejecutamos la autenticación original
        $response = parent::handle($request, $next, ...$guards);

        // Verificamos si el usuario está autenticado y si está activo
        if (Auth::check() && !Auth::user()->is_active) {
            Auth::logout();

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Tu cuenta está desactivada.'
                ], 403);
            }

            return redirect()->route('login')
                ->with('error', 'Tu cuenta está desactivada. Por favor contacta al administrador.');
        }

        return $response;
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
