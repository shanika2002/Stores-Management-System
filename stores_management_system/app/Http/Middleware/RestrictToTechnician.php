<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictToTechnician
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth('admin')->check() || auth('admin')->user()->role !== 'Technician') {
            return redirect()->route('admin.index')->with('error', 'Access denied. Technicians only.');
        }

        return $next($request);
    }
}
