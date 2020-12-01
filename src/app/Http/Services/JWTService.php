<?php

namespace App\Http\Services;

use Illuminate\Support\Str;
use Psy\Util\Json;

class JWTService
{
    /**
     * @param  array  $data
     *
     * @return string
     */
    public static function generateJWT(array $data): string
    {
        $header = JSON::encode([
            'alg' => 'HS256',
            'typ' => 'JWT'
        ]);
        $payload = JSON::encode($data);

        $b64Header = self::b64JWT($header);
        $b64Payload = self::b64JWT($payload);
        $b64Sign = self::hashToken($b64Header, $b64Payload);

        return $b64Header.'.'.$b64Payload.'.'.$b64Sign;
    }

    /**
     * @param $token string
     * @param $secret string
     *
     * @return bool
     */
    public static function verify(string $token, string $secret = null): bool
    {
        if ($secret === null) {
            $secret = env('JWT_SECRET');
        }
        if (count(Str::of($token)->matchAll('/\./')) !== 2) {
            return false;
        }
        [$header, $payload, $sign] = Str::of($token)->split('/[\s.]+/');
        $b64Sign = self::hashToken($header, $payload, $secret);

        return $sign === $b64Sign;
    }

    /**
     * @param  string  $token
     *
     * @return array|bool
     */
    public static function getPayload(string $token): array
    {
        if (count(Str::of($token)->matchAll('/\./')) !== 2) {
            return false;
        }
        [$header, $payload, $sign] = Str::of($token)->split('/[\s.]+/');
        $payload = json_decode(self::decode_b64JWT($payload), true);

        return $payload;
    }

    /**
     * @param $header string
     * @param $payload string
     * @param  null  $secret  string|null
     *
     * @return string
     */
    private static function hashToken(string $header, string $payload, $secret = null): string
    {
        if ($secret === null) {
            $secret = env('JWT_SECRET');
        }

        $sign = hash_hmac('sha256', $header.'.'.$payload, $secret, true);
        return self::b64JWT($sign);
    }

    /**
     * @param $string string
     *
     * @return string
     */
    private static function b64JWT(string $string): string
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($string));
    }

    /**
     * @param $string string
     *
     * @return string
     */
    private static function decode_b64JWT(string $string): string
    {
        return base64_decode(str_replace(['-', '_'], ['+', '/'], $string));
    }
}
