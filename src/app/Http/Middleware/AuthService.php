<?php

namespace App\Http\Middleware;

use App\Events\FailedServiceAuthEvent;
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
        $service = Service::whereToken($token)->first();

        if (!$service) {
            FailedServiceAuthEvent::dispatch($service, $request, false);
            return response()->json(['message' => 'Unknown api token'], 401);
        }
        FailedServiceAuthEvent::dispatch($service, $request, true);

        return $next($request);
    }
}
