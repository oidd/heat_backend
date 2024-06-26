<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (($account = DB::table('admin')
            ->where('login', '=', $credentials['login'])
            ->get('password')->first()) == null)
        {
            return response()->json(['message' => 'Account with this login doesn\`t exist'], 400);
        }

        if ($account->password == md5($credentials['password']))
        {
            return response()->json(['token' => $this->generate_token($credentials['login'])]);
        }

        return response()->json(['message' => 'Login and password doesn\'t match']);
    }

    private function generate_token(string $username)
    {
        $issued_at = time();
        $expiration_time = $issued_at + (60 * 60 * 24);

        $payload = array(
            'iat' => $issued_at,
            'exp' => $expiration_time,
            'sub' => $username,
        );

        return JWT::encode($payload, app()['config']['jwt.secret'], 'HS256');
    }
}
