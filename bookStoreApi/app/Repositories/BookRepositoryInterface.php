<?php


namespace App\Repositories;
use App\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Collection;

interface BookRepositoryInterface
{
    public function all(): Collection;
    public function findById($id): Collection;
    public function create(StoreBookRequest $request);
    public function createWithTranslations(StoreBookRequest $request);
    public function update(UpdateBookRequest $request, Book $book);
    public function delete(Book $book);
}
