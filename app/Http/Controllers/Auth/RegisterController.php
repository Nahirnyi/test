<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\User;

class RegisterController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RegisterRequest $request)
    {
        $user = new User([
           'name' => request('name'),
           'email' => request('email'),
           'password' => request('password')
        ]);

        $user->save();

        return response()->json([
            config('models.messages.message') => config('models.controllers.user.statuses.created'),
        ], 201);
    }
}
