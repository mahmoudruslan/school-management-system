<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\repositories\BooksRepositoryInterface;
use App\repositories\Eloquent\GradesRepository;
use App\Traits\SaveImgTrait;
use Illuminate\Support\Str;

class BooksController extends Controller
{
    use SaveImgTrait;
    private $book;
    public function __construct(BooksRepositoryInterface $book)
    {
        $this->book = $book;
    }
    public function index(Request $request)
    {
        $teacher_id = $request->teacher_id;
        $books = $this->book->getData();
        return view('pages.books.index', compact(['books', 'teacher_id']));
    }

    public function create(GradesRepository $g)
    {
        $books = $this->book->getData();
        $grades = $g->getData();
        return view('pages.books.create', compact(['grades', 'books']));
    }

    public function store(Request $request)
    {
        $photo = $request->file_name->getClientOriginalExtension();
        $name = time() . Str::random(6) . '.' . $photo;
        $request->file_name->storeAs('attachments/books/' . $request->title, $name, 'attachments');
        $this->book->create([
            'title' => $request->title,
            'file_name' => $name,
            'teacher_id' => 1,
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
            'section_id' => $request->section_id
        ]);
        return redirect()->route('books.index');
    }


    public function destroy(Request $request)
    {
        $this->deleteFiles('books/' . $request->title, $request->file_name, 0);
        $this->book->destroy($request->id);
        return redirect()->back();
    }

    public function download(Request $request)
    {
        return response()->download(public_path('attachments/books/' . $request->title . '/' . $request->file_name));
    }
}
