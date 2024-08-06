<?php

namespace App\Http\Middleware;

use App\Models\Game;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsDeveloper
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $game = Game::where('slug', $request->slug)->first();
        if($game->author_id === auth()->user()->id) {
            return $next($request);
        }
        return response()->json([
            'status' => 'forbidden',
            'message' => 'You are not the game author',
        ], 403);
    }
}
