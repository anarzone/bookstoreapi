<?php


namespace App\Repositories;


use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;
    public function findById($id): Collection;
    public function create(StoreUserRequest $request);
    public function update(UpdateUserRequest $request, User $user);
    public function delete(User $user);
}
