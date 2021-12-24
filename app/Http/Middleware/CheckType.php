<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (auth()->user()->role_as == 1) {
                return $next($request);
            } else {
                return response()->json([

                    'message' => 'Access Deneid As Your Are An Admin ! ^+^',
                ],403);
            }
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Please Login First ^+^',
            ]);
        }
    }
}
