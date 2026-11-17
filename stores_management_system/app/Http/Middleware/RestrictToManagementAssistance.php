<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictToManagementAssistance
{
    /**
     * Handle an incoming request.
     */
    // app/Http/Middleware/RestrictToManagementAssistance.php
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth('admin')->check() || auth('admin')->user()->role !== 'Management Assistance') {
            return redirect()->route('admin.index')->with('error', 'Access denied.');
        }

        return $next($request);
    }

}
