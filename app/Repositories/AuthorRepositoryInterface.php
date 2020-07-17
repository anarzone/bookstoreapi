<?php


namespace App\Repositories;


use App\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\Support\Collection;

interface AuthorRepositoryInterface
{
    public function all(): Collection;
    public function find(Author $author): Collection;
    public function create(StoreAuthorRequest $request);
    public function update(UpdateAuthorRequest $request, Author $author);
    public function delete(Author $author);
}
