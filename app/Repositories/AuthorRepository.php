<?php


namespace App\Repositories;


use App\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\Support\Collection;

class AuthorRepository implements AuthorRepositoryInterface
{
    private $model;

    public function __construct(Author $author)
    {
        $this->model = $author;
    }

    public function all(): Collection
    {
        // TODO: Implement all() method.
    }

    public function find(Author $author): Collection
    {
        // TODO: Implement findById() method.
    }

    public function create(StoreAuthorRequest $request)
    {
        return $this->model->create($request->all());
    }

    public function update(UpdateAuthorRequest $request, Author $author)
    {
        // TODO: Implement update() method.
    }

    public function delete(Author $author)
    {
        // TODO: Implement delete() method.
    }
}
