<?php


namespace App\Repositories;

use App\Book;
use App\BookTranslations;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Collection;

class BookRepository implements BookRepositoryInterface
{
    private $model;

    public function __construct(Book $book)
    {
        $this->model = $book;
    }

    public function all(): Collection
    {
        return $this->model->with('translation')->get();
    }

    public function findById($id): Collection
    {
        // TODO: Implement findById() method.
    }

    public function create(StoreBookRequest $request)
    {

    }

    public function createWithTranslations(StoreBookRequest $request)
    {
        $book = $this->model->create([
           'isbn'   => $request->isbn,
           'price'  => $request->price,
           'amount' => $request->amount,
        ]);

        BookTranslations::create([
            'title'       => $request->title,
            'description' => $request->description,
            'locale'      => app()->getLocale(),
            'book_id'     => $book->id
        ]);

        return $book->load('translation')->get();
    }

    /**
     * @param UpdateBookRequest $request
     * @param Book $book
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $this->model->update([
            'isbn' => $request->isbn,
            'price' => $request->price,
            'amount' => $request->amount,
        ]);

        $book->translation()->update([
           'title' => $request->title,
           'description' => $request->description,
        ]);

        return $book->load('translation');
    }

    public function delete(Book $book)
    {
        // TODO: Implement delete() method.
    }

}
