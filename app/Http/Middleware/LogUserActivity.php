<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogUserActivity
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $this->logActivity($request);

        return $response;
    }

    private function logActivity(Request $request)
    {
        DB::table('user_activities')->insert([
            'user_id' => Auth::id() ?? null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'url' => $request->fullUrl(),
            'module' => $this->getModuleName($request),
            'created_at' => now(),
        ]);
    }

    private function getModuleName(Request $request)
    {
        $path = $request->path();
        $segments = explode('/', $path);
        
        // El primer segmento de la URL será considerado como el nombre del módulo
        $module = $segments[0] ?? 'home';

        // Si el primer segmento es 'admin', tomamos el segundo segmento como el nombre del módulo
        if ($module === 'admin' && isset($segments[1])) {
            $module = $segments[1];
        }

        return $module;
    }
}