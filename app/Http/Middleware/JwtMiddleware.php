<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            if (! $request->hasHeader('Authorization')) {
                throw new Exception('Missing Authorization header');
            }

            $token = str_replace('Bearer ', '', $request->header('Authorization'));
            $decoded = JWT::decode($token, env('JWT_SECRET'), ['HS256']);

            // Добавляем объект пользователя в Request для дальнейшего использования в контроллерах
            $request->merge(['user' => $decoded]);

            // Продолжаем выполнение запроса
            return $next($request);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
}
