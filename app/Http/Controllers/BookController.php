<?php

namespace App\Http\Controllers;

use App\Book;
use App\Services\BookParser;
use App\Services\BookService;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class BookController extends Controller
{
    /**
     * @param Request $request
     * @param BookService $bookService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, BookService $bookService)
    {
        $books = new Book();
        $params = $request->all();
        if (isset($params['search'])) {
            $books = $books->where('name', 'like', '%' . $params['search'] . '%')
                ->orWhere('authors', 'like', '%' . $params['search'] . '%');
        }
        $books = $books->paginate(10);

        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
