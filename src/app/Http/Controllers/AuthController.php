<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthorizeRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\ApiToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function auth(AuthorizeRequest $request): \Illuminate\Http\JsonResponse
    {
        $code = $request->bearerToken() === 'SECRET' ? 200 : 401;
        $token = (string) $request->header('Auth-Token');
        /** @var ApiToken|null $token */
        $token = ApiToken::find($token);

        if ($token === null || $code !== 200) {
            return response()->json(
                ['status' => 'ERROR'],
                $code
            );
        }

        return response()->json(['status' => 'OK'], $code);
    }

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        [$login, $email, $password] = array_values($request->all(['login', 'email', 'password']));
        /** @var User|null $user */
        $user = User::
            where(function ($query) use ($login, $email) {
                $query->where('login', $login)
                    ->orWhere('email', $email);
            })
            ->first();
        if ($user === null) {
            return response()->json(['message' => 'Wrong login/password'], 403);
        } elseif (!Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Wrong login/password'], 403);
        }

        $token = new ApiToken();
        if (!$user->tokens()->save($token)) {
            throw new \App\Exceptions\SaveFailed();
        }
        return response()->json(['token' => $token->token]);
    }
}
