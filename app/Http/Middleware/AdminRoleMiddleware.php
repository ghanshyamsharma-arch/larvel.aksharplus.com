<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminRoleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Please log in to continue.');
        }

        if (! Auth::user()->hasRole('admin')) {
            Auth::logout();
            return redirect()->route('admin.login')
                ->with('error', 'Access denied. Admin privileges required.');
        }

        if (Auth::user()->status !== 'active') {
            Auth::logout();
            return redirect()->route('admin.login')
                ->with('error', 'Your account has been suspended.');
        }

        return $next($request);
    }
}
