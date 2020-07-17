<?php


namespace App\Repositories;


use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function findById($id): Collection
    {
        // TODO: Implement findById() method.
    }

    public function create(StoreUserRequest $request)
    {
        return $this->model->create($request->all());
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        return $user->update($request->all());
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
