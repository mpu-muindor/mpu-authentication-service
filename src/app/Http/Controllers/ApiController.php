<?php

namespace App\Http\Controllers;

use App\Http\Services\JWTService as JWT;
use App\Models\User;
use Illuminate\Http\Request;

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
        $data = JWT::getPayload($jwt);
        $user = User::whereId($data['id'])->first();

        return response()->json($user->toArray());
    }

    public function getProfessorData(Request $request)
    {
        $jwt = $request->bearerToken();
        $data = JWT::getPayload($jwt);
        $user = User::whereId($data['id'])->with('professors.employmentDatas')->first();

        if (!$user->isProfessor) {
            return response()->json(['message' => 'Unauthorized token'], 403);
        }

        return response()->json($user->toArray());
    }

    public function getStudentData(Request $request)
    {
        $jwt = $request->bearerToken();
        $data = JWT::getPayload($jwt);
        $user = User::whereId($data['id'])->with('students')->first();

        if (!$user->isStudent) {
            return response()->json(['message' => 'Unauthorized token'], 403);
        }

        return response()->json($user->toArray());
    }
}
