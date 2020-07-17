<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepositoryInterface;
use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth:user', ['except' => ['']]);
    }

    public function index(){
        $users = $this->userRepository->all();

        return response()->json([
            'data' => UserResource::collection($users),
        ]);
    }

    public function create(StoreUserRequest $request){

        $request->validated();

        $user = $this->userRepository->create($request);

        return response()->json([
           'message' => 'Successfully created',
           'data'    => new UserResource($user)
        ]);
    }

    public function update(UpdateUserRequest $request, User $user){
        $request->validated();
        $this->userRepository->update($request, $user);

        return response()->json([
            'message' => 'Successfully updated',
        ]);
    }
}
