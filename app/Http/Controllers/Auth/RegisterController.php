<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\User;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        $user = new User([
           'name' => request('name'),
           'email' => request('email'),
           'password' => request('password')
        ]);

        $user->save();

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
}
