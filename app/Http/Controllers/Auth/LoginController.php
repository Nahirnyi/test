<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        try {
            if (!$token = JWTAuth::attempt($credentials))
            {
                return response()->json([
                    config('models.messages.error') => config('models.controllers.user.errors.invalidCredentials')
                ], Response::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e){
            return response()->json([
                config('models.messages.error') => config('models.controllers.user.errors.couldNotCreateToken')
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(compact('token'), Response::HTTP_OK);
    }
}
