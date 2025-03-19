<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('web')->user()->role !== 'worker') {
            return redirect()->route('admin.dashboard'); // Redirect non-workers to admin dashboard
        }
        return $next($request);
    }
}
