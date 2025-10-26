<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check: User logged 
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            // Admin না হলে 403 error
            abort(403, 'Unauthorized action. Admin access required.');
        }

        // Admin request proceed করবে
        return $next($request);
    }
}