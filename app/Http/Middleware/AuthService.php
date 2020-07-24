<?php

namespace App\Http\Middleware;

use App\Models\Service;
use Closure;

class AuthService
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->validate(['api_token' => 'required|string']);
        $token = $request->get('api_token');
        if (!Service::whereToken($token)->first()) {
            return response()->json(['message' => 'Unknown api token'], 401);
        }

        return $next($request);
    }
}
