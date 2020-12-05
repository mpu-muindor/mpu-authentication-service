<?php

namespace App\Http\Services;

use Illuminate\Support\Str;
use Psy\Util\Json;

class JWTService
{
    /**
     * @param array $data
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

        return $b64Header . '.' . $b64Payload . '.' . $b64Sign;
    }

    /**
     * @param string $token
     * @param string|null $secret
     * @return bool
     */
    public static function verify(string $token, string $secret = null): bool
    {
        if ($secret === null) {
            $secret = \Config::get('app.JWTSecret');
        }
        if (Str::of($token)->matchAll('/\./')->count() !== 2) {
            return false;
        }
        [$header, $payload, $sign] = Str::of($token)->split('/[\s.]+/');
        $b64Sign = self::hashToken($header, $payload, $secret);

        return $sign === $b64Sign;
    }

    /**
     * @param string $token
     *
     * @return array|null
     */
    public static function getPayload(string $token): ?array
    {
        if (Str::of($token)->matchAll('/\./')->count() !== 2) {
            return null;
        }
        [$header, $payload, $sign] = Str::of($token)->split('/[\s.]+/');
        $payload = json_decode(self::decodeToBase64JWT($payload), true, 512, JSON_THROW_ON_ERROR);

        return $payload;
    }

    /**
     * @param string $header
     * @param string $payload
     * @param string|null $secret
     *
     * @return string
     */
    private static function hashToken(string $header, string $payload, $secret = null): string
    {
        if ($secret === null) {
            $secret = \Config::get('app.JWTSecret');
        }

        $sign = hash_hmac('sha256', $header . '.' . $payload, $secret, true);
        return self::b64JWT($sign);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    private static function b64JWT(string $string): string
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($string));
    }

    /**
     * @param string $string
     *
     * @return string
     */
    private static function decodeToBase64JWT(string $string): ?string
    {
        return base64_decode(str_replace(['-', '_'], ['+', '/'], $string)) ?: null;
    }
}
