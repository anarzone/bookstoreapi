<?php

namespace App\Http\Controllers\V1;

use App\Book;
use App\Helpers\BooksHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Repositories\BookRepository;
use App\Repositories\BookRepositoryInterface;

class BookController extends Controller
{
    use BooksHelper;

    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * BookController constructor.
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->middleware('auth:user', ['except' => ['']]);
    }

    public function index(){
        $booksWithTranslations = $this->bookRepository->all();

        $books = $this->mapRequest($booksWithTranslations);

        return response()->json([
            'data' => $books
        ]);
    }

    /**
     * @param StoreBookRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(StoreBookRequest $request){
        $request->validated();

        $bookWithTranslations = $this->bookRepository->createWithTranslations($request);

        $bookData = $this->mapRequest($bookWithTranslations);

        return response()->json([
            'message' => 'Success',
            'data' => $bookData
        ]);
    }

    /**
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBookRequest $request, Book $book){
        $request->validated();
        $this->bookRepository->update($request, $book);

        return response()->json(['message' => 'Success']);
    }

//    public function translatables($translations){
//        if (!$translations) return [];
//
//        $translatables = [];
//
//        foreach ($translations as $translation){
//            $translatables[] = new BookTranslations([
//                'title' => $translation->title,
//                'description' => $translation->description,
//                'locale' => app()->getLocale()
//            ]);
//        }
//
//        return $translatables;
//    }
}
