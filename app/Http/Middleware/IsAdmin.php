<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // ❌ belum login
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        // ❌ bukan admin
        if (!auth()->user()->isAdmin()) {
            return response()->json([
                'message' => 'Forbidden - Admin Only'
            ], 403);
        }

        // ✅ lanjut
        return $next($request);
    }
}
