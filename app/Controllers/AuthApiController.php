<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Config;
use App\Core\ApiResponse;
use App\Models\User;

/**
 * متحكم المصادقة API - JWT (JSON Only)
 */
class AuthApiController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    /**
     * تسجيل الدخول API (JSON)
     */
    public function login(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if (!$email || !$password) {
            ApiResponse::error('Email و Password مطلوبين', 400);
        }

        $user = $this->userModel->validateLogin($email, $password);
        if (!$user) {
            ApiResponse::error('بيانات تسجيل الدخول غير صحيحة', 401);
        }

        $secret = Config::get('app.jwt_secret', 'secret_default_key');
        $exp    = Config::get('app.jwt_exp', 3600);

        $token = $this->createJWT([
            'user_id' => $user->id,
            'email'   => $user->email,
            'exp'     => time() + $exp
        ], $secret);

        ApiResponse::success([
            'token' => $token,
            'user'  => [
                'id'        => $user->id,
                'email'     => $user->email,
                'username'  => $user->username ?? null,
                'full_name' => $user->full_name ?? null
            ]
        ], 'تم تسجيل الدخول بنجاح');
    }

    /**
     * تسجيل الخروج (JWT Stateless)
     */
    public function logout(): void
    {
        ApiResponse::success(null, 'تم تسجيل الخروج');
    }

    /**
     * التحقق من صلاحية JWT
     */
    public static function requireAuth(): array
    {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? '';

        if (!$authHeader) {
            ApiResponse::error('Unauthorized', 401);
        }

        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            ApiResponse::error('Invalid token format', 401);
        }

        $secret = Config::get('app.jwt_secret', 'secret_default_key');
        $decoded = self::verifyJWT($matches[1], $secret);

        if (!$decoded) {
            ApiResponse::error('Invalid token', 401);
        }

        if (($decoded['exp'] ?? 0) < time()) {
            ApiResponse::error('Token expired', 401);
        }

        return $decoded;
    }

    /**
     * إنشاء JWT
     */
    private function createJWT(array $payload, string $secret): string
    {
        $header = ['alg' => 'HS256', 'typ' => 'JWT'];

        $base64Header  = self::base64UrlEncode(json_encode($header));
        $base64Payload = self::base64UrlEncode(json_encode($payload));

        $signature = hash_hmac(
            'sha256',
            "$base64Header.$base64Payload",
            $secret,
            true
        );

        $base64Signature = self::base64UrlEncode($signature);

        return "$base64Header.$base64Payload.$base64Signature";
    }

    /**
     * التحقق من JWT
     */
    private static function verifyJWT(string $token, string $secret): false|array
    {
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            return false;
        }

        [$header, $payload, $signature] = $parts;

        $expected = self::base64UrlEncode(
            hash_hmac('sha256', "$header.$payload", $secret, true)
        );

        if (!hash_equals($expected, $signature)) {
            return false;
        }

        return json_decode(self::base64UrlDecode($payload), true);
    }

    private static function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function base64UrlDecode(string $data): string
    {
        $padding = 4 - (strlen($data) % 4);
        if ($padding < 4) {
            $data .= str_repeat('=', $padding);
        }
        return base64_decode(strtr($data, '-_', '+/'));
    }
}
