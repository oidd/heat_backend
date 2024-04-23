<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->input('jwt') == null)
            return response()->json(['message' => 'No token provided'], 401);

        if ($this->validate_jwt_token($request->input('jwt')))
            return $next($request);

        return response()->json(['message' => 'token expired'], 401);
//        return $next($request);
    }

    private function validate_jwt_token($token)
    {
        try {
            JWT::decode($token, new Key(env('JWT_KEY'), 'HS256'));
        } catch (Exception $e) {
            return false;
        }

        return true;
    }
}
