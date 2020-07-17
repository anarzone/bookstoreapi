<?php

namespace App\Http\Controllers\V1;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user', ['except' => ['login', 'register']]);
    }

    public function register(StoreUserRequest $request){
        $request->validated();
        $user = User::create([
           'name'       => $request->get('name'),
           'email'      => $request->get('email'),
           'password'   => Hash::make($request->get('password')),
        ]);

        $token = auth('user')->login($user);
        return $this->respondWithToken($token);
    }

    public function login(){
        $credentials = request(['email', 'password']);
        if(!$token = Auth::guard('user')->attempt($credentials)){
            return response()->json('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    public function getUser(){
        return response()->json(auth('user')->user());
    }

    public function logout(){
        auth('user')->logout();
        return response()->json(['message' => 'Logged out']);
    }

    public function refresh(){
        return $this->respondWithToken(auth()->refresh());
    }

    public function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('user')->factory()->getTTL() * 60
        ]);
    }
}
