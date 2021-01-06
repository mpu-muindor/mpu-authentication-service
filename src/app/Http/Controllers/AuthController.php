<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthorizeRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UserGetByIdRequest;
use App\Models\ApiToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function auth(AuthorizeRequest $request): \Illuminate\Http\JsonResponse
    {
        $token = (string) $request->get('token');
        /** @var ApiToken|null $token */
        $token = ApiToken::find($token);

        if ($token === null) {
            return response()->json(
                ['active' => false],
                403
            );
        }

        return response()->json(['active' => true]);
    }

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        [$login, $email, $password] = array_values($request->all(['login', 'email', 'password']));
        $password = Hash::make($password);
        /** @var User|null $user */
        $user = User::
            where(function ($query) use ($login, $email) {
                $query->where('login', $login)
                    ->orWhere('email', $email);
            })
            ->where('password', $password)
            ->first();
        if ($user === null) {
            return response()->json(['message' => 'Wrong login/password'], 403);
        }

        $token = new ApiToken();
        if (!$user->tokens()->save($token)) {
            throw new \App\Exceptions\SaveFailed();
        }
        return response()->json(['token' => $token->token]);
    }

    public function getById(UserGetByIdRequest $request): ?array
    {
        $id = $request->input('id');

        $user = User::find($id);
        if ($user === null) {
            return null;
        }

        return $user->toArray();
    }
}
