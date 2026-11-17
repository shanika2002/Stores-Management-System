<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictToStockKeeper
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth('admin')->check() || !in_array(auth('admin')->user()->role, ['Admin', 'Manager', 'Stock Keeper'])) {
            return redirect()->route('admin.index')->with('error', 'Access denied. Stock Keepers, Managers, or Admins only.');
        }
        return $next($request);
    }
}