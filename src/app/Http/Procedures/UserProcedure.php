<?php

declare(strict_types=1);

namespace App\Http\Procedures;

use App\Exceptions\PasswordInvalid;
use App\Exceptions\UserNotFoundException;
use App\Exceptions\UserSaveFailException;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Sajya\Server\Procedure;

class UserProcedure extends Procedure
{
    public static string $name = 'users';

    /**
     * @param RegisterRequest $request
     * @throw UserSaveFailException 1002
     * @return array
     */
    public function register(RegisterRequest $request): array
    {
        $user = new User();
        $user->login = $request->get('login');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));

        if ($user->save()) {
            return [
                'id' => $user->id,
            ];
        }

        throw (new UserSaveFailException());
    }

    /**
     * @param UpdatePasswordRequest $request
     * @throw UserNotFoundException 1001
     * @throw UserSaveFailException 1002
     * @throw PasswordInvalid 1003
     * @return array
     */
    public function updatePassword(UpdatePasswordRequest $request): array
    {
        $id = $request->get('id');
        $old_password = $request->get('old_password');
        $new_password = $request->get('new_password');
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            throw (new UserNotFoundException());
        }

        if (Hash::check($old_password, $user->password)) {
            if ($user->update(['password' => Hash::make($new_password)])) {
                return [
                    'id' => $user->id,
                ];
            }
        } else {
            throw (new PasswordInvalid());
        }

        throw (new UserSaveFailException());
    }
}
