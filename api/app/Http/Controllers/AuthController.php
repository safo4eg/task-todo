<?php

namespace App\Http\Controllers;

use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')
            ->only('logout');
    }

    public function signup(SignupRequest $request)
    {
        $attributes = $request->safe()->only(['username', 'password']);
        $user = User::create($attributes);
        return new JsonResponse([
            'data' => ['token' => $user->createToken('token')->plainTextToken]
        ]);
    }

    public function signin(SigninRequest $request)
    {
        $attributes = $request->validated();
        $user = User::where('username', $attributes['username'])->first();
        if(!Hash::check($attributes['password'], $user->password)) {
            throw ValidationException::withMessages([
                'login' => 'The provided credentials ara incorrect'
            ]);
        }

        return new JsonResponse([
            'data' => ['token' => $user->createToken('token')->plainTextToken]
        ], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return new JsonResponse([
            'data' =>[]
        ], Response::HTTP_NO_CONTENT);
    }
}
