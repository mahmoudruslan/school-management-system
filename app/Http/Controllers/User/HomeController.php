<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\repositories\AttendanceRepositoryInterface;
use App\repositories\BookRepositoryInterface;
use App\repositories\FeesInvoiceRepositoryInterface;
use App\repositories\ResultRepositoryInterface;
use App\repositories\StudentAccountRepositoryInterface;
use App\repositories\StudentRepositoryInterface;
use App\repositories\SubjectRepositoryInterface;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\repositories\Eloquent\AttendanceRepository;
use App\repositories\Eloquent\BookRepository;
use App\repositories\Eloquent\FeesInvoiceRepository;
use App\repositories\Eloquent\ResultRepository;
use App\repositories\Eloquent\StudentAccountRepository;
use App\repositories\Eloquent\StudentRepository;
use App\repositories\Eloquent\SubjectRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    private $student;
    private $result;
    private $student_account;
    private $subject;

    public function __construct(
        StudentRepository  $student,
        ResultRepository   $result,
        StudentAccountRepository $student_account,
        SubjectRepository $subject
    )
    {
        $this->student = $student;
        $this->result = $result;
        $this->student_account = $student_account;
        $this->subject = $subject;

    }

    public function student()
    {
        return view('student_dashboard.student');
    }

    //student information
    public function getData()
    {
        $student = $this->student->getById(Auth::id());
        return view('student_dashboard.pages.show', ['student' => $student]);
    }


    //student results
    public function getResults() {
        $credit = $this->student_account->myModel()->where('student_id', Auth::id())->select('credit')->sum('credit');//student credit
        $debit = $this->student_account->myModel()->where('student_id', Auth::id())->select('debit')->sum('debit');// student debit
        $student = Auth::user();
        $student_results = $this->result->all([])->where('student_id', $student->id);//student results

        $results_classrooms = $student_results->unique('classroom_id'); //get classroom names without repetition
        $results_grades = $student_results->unique('grade_id'); //get grade names without repetition
        $total = $this->subject->myModel()->where('classroom_id', $student->classroom_id)->sum('degree');
        return view('student_dashboard.pages.result', compact(['total', 'student_results', 'results_classrooms', 'results_grades', 'credit', 'debit']));
    }

    //student Courses
    public function getCourses()
    {
        $subjects = $this->subject->myModel()->where('classroom_id', Auth::user()->classroom_id)->get();
        return view('student_dashboard.pages.subjects', compact('subjects'));
    }

    //student fees
    public function getFees(FeesInvoiceRepository $fee)
    {
        $credit = $this->student_account->myModel()->where('student_id', Auth::id())->select('credit')->sum('credit');
        $debit = $this->student_account->myModel()->where('student_id', Auth::id())->select('debit')->sum('debit');
        $invoices = $fee->myModel()
            ->where('student_id', Auth::id())
            ->where('grade_id', Auth::user()->grade_id)
            ->where('classroom_id', Auth::user()->classroom_id)->get();
        return view('student_dashboard.pages.fees', compact('invoices', 'debit', 'credit'));
    }

    //student absence
    public function getAbsence(AttendanceRepository $attendance)
    {
        $attendances = $attendance->myModel()->where('student_id', Auth::id())->select('date', 'admin_id')->get();
        return view('student_dashboard.pages.absence', compact('attendances'));
    }

    //student PDF
    public function getBooks(BookRepository $book)
    {
        $books = $book->myModel()->where('classroom_id', Auth::user()->classroom_id)->select('title', 'admin_id', 'file_name')->get();
        return view('student_dashboard.pages.books', compact('books'));
    }


    //download PDF
    public function download(Request $request)
    {
        return response()->download(public_path('attachments/books/' . $request->title . '/' . $request->file_name));
    }

    //change password form
    public function setting()
    {
        return view('student_dashboard.pages.edit_password');
    }

    //change password
    public function editPassword(Request $request)
    {
        $request->validate([
            'curent_password' => 'required',
            'new_password' => 'required|max:8',
            'confirm_password' => 'required|max:8',
        ]);
        $curentPassword = Auth::user()->password;
        if (!Hash::check($request->curent_password, $curentPassword)) {
            return redirect()->back()->with('error', __('The password is incorrect'));
        } elseif ($request->new_password !== $request->confirm_password) {
            return redirect()->back()->with('error', __('Passwords do not match'));
        } else {
            $this->student->update([
                'password' => $request->new_password
            ], Auth::id());
            return redirect()->back();
        }
    }

    //If the student forgets the password
    public function resetPassword(ResetPasswordRequest $request)
    {
        $student = $this->student->myModel()->where('email', $request->email)->first();

        if (!isset($student)) {
            return redirect()->back()->with('error', __('The Email is incorrect'));
        }
        $father_national_id = $student->parents->father_national_id;
        if ($father_national_id !== $request->father_national_id) {
            return redirect()->back()->with('error', __('The father_national_id is incorrect'));
        }
        if ($request->new_password !== $request->confirm_password) {
            return redirect()->back()->with('error', __('Passwords do not match'));
        } else {
            $this->student->update([
                'password' => $request->new_password
            ], $student->id);

            if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->new_password])) {
                return redirect()->intended(RouteServiceProvider::STUDENT);
            }
        }
    }
}
