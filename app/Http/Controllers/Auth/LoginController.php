<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

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
                ], Response::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e){
            return response()->json([
                'error' => 'Could not create token'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'token' => $token
        ], Response::HTTP_OK);
    }
}
