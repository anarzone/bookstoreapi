<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Resources\Author as AuthorResource;
use App\Repositories\AuthorRepositoryInterface;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
        $this->middleware('auth:user', ['except' => []]);
    }

    public function index(){

    }

    public function show(){

    }

    public function all(){

    }

    public function create(StoreAuthorRequest $request){
        $request->validated();
        $author = $this->authorRepository->create($request);

        return response()->json([
            "message" => "Success",
            'data'  => new AuthorResource($author),
        ]);
    }

    public function update(){

    }
}
