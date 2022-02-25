<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\repositories\BooksRepositoryInterface;

class BooksController extends Controller
{
    private $book;
    public function __construct(BooksRepositoryInterface $book)
    {
        $this->book = $book;
    }
    public function index()
    {
        $books = $this->book->getData();
        return $books;
        return view('pages.books.index', compact(['books']));
    }

    public function store(Request $request)
    {
        $this->book->create($request->all());
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $this->book->update($request->all(), $request->id);
        toastr()->success(__('Data updated successfully'));
        return redirect()->back();
    }

    public function destroy()
    {
        toastr()->success(__('Data deleted successfully'));
        return redirect()->back();
    }
}
