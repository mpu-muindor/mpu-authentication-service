<?php

namespace App\Http\Controllers;

use App\Http\Services\JWTService as JWT;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Professor;
use App\Models\ReleasedToken;
use App\Models\Service;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceApiController extends Controller
{
    /**
     * @param  string  $title
     *
     * @return Service
     */
    public function regisrter(string $title): Service
    {
        $service = new Service();
        $token = Str::random(48);
        $service->save(['title' => $title, 'token' => $token]);

        return $service;
    }

    public function verifyUserToken(Request $request)
    {
        $request->validate(['jwt' => 'required|string']);
        $jwt = $request->get('jwt');

        if (!JWT::verify($jwt)) {
            return response()->json(['message' => 'Wrong token', 'result' => false]);
        }
        $rt = ReleasedToken::find(sha1($jwt));
        if (!$rt) {
            return response()->json(['message' => 'Unknown token', 'result' => false]);
        }
        if ($rt->updated_at->addHour() < now()) {
            return response()->json(['message' => 'Token is expired', 'result' => false]);
        }

        return response()->json(['message' => 'Token is valid', 'result' => true]);
    }

    public function getUserList()
    {
        return User::with(['students', 'professors.employmentDatas'])->get();
    }

    public function getProfessors()
    {
        return Professor::with(['employmentDatas', 'user'])->get();
    }

    public function getStudents()
    {
        return Student::with(['user'])->get();
    }

    public function getFaculties()
    {
        return Faculty::all();
    }

    public function getDepartments()
    {
        return Department::all();
    }

    public function getGroups()
    {
        return Group::all();
    }
}
