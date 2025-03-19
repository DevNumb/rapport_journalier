<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('web')->user()->role !== 'admin') {
            return redirect()->route('worker.tasks'); // Redirect non-admins to worker tasks
        }
        return $next($request);
    }
}
