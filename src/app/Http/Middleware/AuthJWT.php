<?php

namespace App\Http\Middleware;

use App\Http\Services\JWTService as JWT;
use App\Models\ReleasedToken;
use Closure;

class AuthJWT
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
        $jwt = $request->bearerToken();
        if (!JWT::verify($jwt)) {
            return response()->json(['message' => 'Wrong token'], 401);
        }
        /** @var ReleasedToken|null $rt */
        $rt = ReleasedToken::find(sha1($jwt));
        if (!isset($rt)) {
            return response()->json(['message' => 'Unknown token'], 403);
        }
        if ($rt->updated_at->addHour() < now()) {
            return response()->json(['message' => 'Token is expired'], 403);
        }

        $rt->touch();
        return $next($request);
    }
}
