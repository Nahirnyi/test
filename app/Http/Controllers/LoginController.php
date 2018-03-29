<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class LoginController extends Controller
{
    public function store(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        try {
            if (!$token = JWTAuth::attempt($credentials))
            {
                return response()->json([
                    'error' => 'Invalid Credentials'
                ], 401);
            }
        } catch (JWTException $e){
            return response()->json([
                'error' => 'Could not create token'
            ], 500);
        }

        return response()->json([
            'token' => $token
        ], 200);
    }
}
