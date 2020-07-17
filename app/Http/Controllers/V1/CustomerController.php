<?php

namespace App\Http\Controllers\V1;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\Customer as CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer', ['except' => ['login', 'register']]);
    }

    public function register(StoreCustomerRequest $request){
        $request->validated();

        $customer = Customer::create([
            'firstname' => $request->get('firstname'),
            'lastname'  => $request->get('lastname'),
            'email'     => $request->get('email'),
            'password'  => Hash::make($request->get('password')),
        ]);

        $token = auth('customer')->login($customer);
        return $this->respondWithToken($token);
    }

    public function login(){
        $credentials = request(['email', 'password']);
        if(!$token = Auth::guard('customer')->attempt($credentials)){
            return response()->json('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    public function logout(){
        auth('customer')->logout();
        return response()->json(['message' => 'Logged out']);
    }

    public function refresh(){
        return $this->respondWithToken(auth()->refresh());
    }

    public function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('customer')->factory()->getTTL() * 60
        ]);
    }

    public function getCustomerInfo($id){
        return new CustomerResource(Customer::find($id));
    }
}
