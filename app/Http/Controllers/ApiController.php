<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Services\JWTService as JWT;

/**
 * Class ApiController
 * Не смотрите >_<,
 * это самое временное из всего временного
 *
 * @package App\Http\Controllers
 */
class ApiController extends Controller
{
    /**
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserData(Request $request)
    {
        $jwt = $request->bearerToken();
        if (!JWT::verify($jwt)) {
            return response()->json(['message' => 'Wrong token'], 401);
        }

        $data = JWT::getPayload($jwt);
        $user = User::whereId($data['id'])->first();

        return response()->json($user->toArray());
    }

    public function getProfessorData(Request $request)
    {
        $jwt = $request->bearerToken();
        if (!JWT::verify($jwt)) {
            return response()->json(['message' => 'Wrong token'], 401);
        }

        $data = JWT::getPayload($jwt);
        $user = User::whereId($data['id'])->with('professors.employmentDatas')->first();

        if ($user->user_type !== 'professor') {
            return response()->json(['message' => 'Unauthorized token'], 403);
        }

        return response()->json($user->toArray());
    }

    public function getStudentData(Request $request)
    {
        $jwt = $request->bearerToken();
        if (!JWT::verify($jwt)) {
            return response()->json(['message' => 'Wrong token'], 401);
        }

        $data = JWT::getPayload($jwt);
        $user = User::whereId($data['id'])->with('students')->first();

        if ($user->user_type !== 'student') {
            return response()->json(['message' => 'Unauthorized token'], 403);
        }

        return response()->json($user->toArray());
    }
}
