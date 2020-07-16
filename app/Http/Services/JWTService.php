<?php
namespace App\Http\Services;

use App\User;

class JWTService
{
    /**
     * @param  User  $user
     *
     * @return string
     */
    public static function generateJWT(User $user)
    {
        $header = json_encode([
            'alg' => 'HS256',
            'typ' => 'JWT'
        ]);
        $payload = $user->toJson();
        $secret = env('JWT_SECRET');

        $b64Header = self::b64JWT($header);
        $b64Payload = self::b64JWT($payload);
        $sign = hash_hmac('sha256', $b64Header . '.' . $b64Payload, $secret, true);
        $b64Sign = self::b64JWT($sign);

        return $b64Header . '.' . $b64Payload . '.' . $b64Sign;
    }

    public static function b64JWT($string)
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($string));
    }
}
