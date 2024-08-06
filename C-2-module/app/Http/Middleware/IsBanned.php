<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->block_reason === null) {
            return $next($request);
        }
        return response()->json([
            'status' => 'blocked',
            'message' => 'User blocked',
            'reason' => config('app.reasons')[auth()->user()->block_reason],
        ]);
    }
}
