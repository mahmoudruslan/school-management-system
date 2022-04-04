<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\repositories\BookRepositoryInterface;
use App\repositories\Eloquent\GradeRepository;
use App\Traits\SaveImgTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookController extends Controller
{
    use SaveImgTrait;
    private $book;
    public function __construct(BookRepositoryInterface $book)
    {
        $this->book = $book;
    }
    public function index(Request $request)
    {

        $books = $this->book->getData();
        return view('admin_dashboard.pages.books.index', compact(['books']));
    }

    public function create(GradeRepository $g)
    {
        $books = $this->book->getData();
        $grades = $g->getData();
        return view('admin_dashboard.pages.books.create', compact(['grades', 'books']));
    }

    public function store(Request $request)
    {
        $photo = $request->file_name->getClientOriginalExtension();
        $name = time() . Str::random(6) . '.' . $photo;
        $request->file_name->storeAs('attachments/books/' . $request->title, $name, 'attachments');
        $this->book->create([
            'title' => $request->title,
            'file_name' => $name,
            'admin_id' => Auth::id(),
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
