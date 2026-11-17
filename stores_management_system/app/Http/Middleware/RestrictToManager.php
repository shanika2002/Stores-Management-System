<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictToManager
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth('admin')->check() || !in_array(auth('admin')->user()->role, ['Admin', 'Manager'])) {
            return redirect()->route('admin.index')->with('error', 'Access denied. Managers or Admins only.');
        }
        return $next($request);
    }
}