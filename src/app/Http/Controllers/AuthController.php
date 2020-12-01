<?php

namespace App\Http\Controllers;

use App\Http\Services\JWTService;
use App\Models\ReleasedToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string', 'unique:users', 'min:4', 'max:32'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:64']
        ]);

        $data = $request->all(['login', 'email', 'password']);
        $data['password'] = Hash::make($data['password']);
        $user = new User($data);

        $user->save();

        return JWTService::generateJWT($user->toArray());
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        $login = $request->get('login');
        $password = $request->get('password');

        $user = User::whereLogin($login)->first();
        if ($user && Hash::check($password, $user->password)) {
            $responseData = [
                'type' => 'JWT',
                'token' => JWTService::generateJWT($user->makeVisible('salt')->toArray()),
            ];
            (new ReleasedToken(['token' => (string) sha1($responseData['token'])]))->save();

            return $responseData;
        }

        return response(['message' => 'Wrong login/password'], 401);
    }

    public function logout(Request $request)
    {
        $jwt = $request->bearerToken();
        $rt = ReleasedToken::find(sha1($jwt));
        if ($rt && $rt->delete()) {
            return response(['message' => 'OK']);
        }

        return response(['message' => 'Something gone wrong! Please contact with admin.'], 500);
    }
}