<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\User;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        $user = new User([
           'name' => request('name'),
           'email' => request('email'),
           'password' => bcrypt(request('password'))
        ]);

        $user->save();

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
}
