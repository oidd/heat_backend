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
        $inputKey = app()['config']['jwt.input_key'];

        if ($request->header($inputKey) == null)
            return response()->json(['message' => 'No token provided'], 401);

        if ($request->user() !== null)
            return $next($request);

        return response()->json(['message' => 'token expired'], 401);
    }
}
