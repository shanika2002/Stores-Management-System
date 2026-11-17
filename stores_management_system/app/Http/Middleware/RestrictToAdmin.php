<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictToAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth('admin')->check() || auth('admin')->user()->role !== 'Admin') {
            return redirect()->route('admin.index')->with('error', 'Access denied. Admins only.');
        }
        return $next($request);
    }
}