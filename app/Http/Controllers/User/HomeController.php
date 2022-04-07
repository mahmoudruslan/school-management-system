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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function student()
    {
        return view('student_dashboard.student');
    }


    public function getData(StudentRepositoryInterface $s)
    {
        $student = $s->getById(Auth::id());
        return view('student_dashboard.pages.show', ['student' => $student]);
    }

    public function getResults(
        ResultRepositoryInterface $r,
        StudentRepositoryInterface $s,
        StudentAccountRepositoryInterface $s_a,
        SubjectRepositoryInterface $subject,
    ) {
        $credit = $s_a->myModel()->where('student_id', Auth::id())->select('credit')->sum('credit');
        $debit = $s_a->myModel()->where('student_id', Auth::id())->select('debit')->sum('debit');

        $student = Auth::user();

        $student_result = $r->getData()
            ->where('student_id', $student->id)
            ->where('grade_id', $student->grade_id);
        $classrooms = $student_result->unique('classroom_id');
        $total = $subject->myModel()->where('classroom_id', $student->classroom_id)->sum('degree');

        return view('student_dashboard.pages.result', compact(['total', 'student_result', 'classrooms', 'credit', 'debit']));
    }
    public function getCourses(SubjectRepositoryInterface $subject, StudentRepositoryInterface $student)
    {
        $subjects = $subject->myModel()->where('classroom_id', Auth::user()->classroom_id)->get();
        return view('student_dashboard.pages.subjects', compact('subjects'));
    }
    public function getFees(FeesInvoiceRepositoryInterface $f, StudentRepositoryInterface $s, StudentAccountRepositoryInterface $s_a)
    {
        $credit = $s_a->myModel()->where('student_id', Auth::id())->select('credit')->sum('credit');
        $debit = $s_a->myModel()->where('student_id', Auth::id())->select('debit')->sum('debit');
        $invoices = $f->myModel()
            ->where('student_id', Auth::id())
            ->where('grade_id', Auth::user()->grade_id)
            ->where('classroom_id', Auth::user()->classroom_id)->get();
        return view('student_dashboard.pages.fees', compact('invoices', 'debit', 'credit'));
    }

    public function getAbsence(AttendanceRepositoryInterface $a)
    {
        return view('auth.passwords.reset');
        $attendances = $a->myModel()->where('student_id', Auth::id())->select('date', 'admin_id')->get();
        return view('student_dashboard.pages.absence', compact('attendances'));
    }
    public function getBooks(BookRepositoryInterface $b)
    {
        $books = $b->myModel()->where('classroom_id', Auth::user()->classroom_id)->select('title', 'admin_id', 'file_name')->get();
        return view('student_dashboard.pages.books', compact('books'));
    }

    public function download(Request $request)
    {
        return response()->download(public_path('attachments/books/' . $request->title . '/' . $request->file_name));
    }

    public function setting()
    {
        return view('student_dashboard.pages.edit_password');
    }
    public function editPassword(Request $request, StudentRepositoryInterface $s)
    {

        $request->validate([
            'curent_password' => 'required',
            'new_password' => 'required|max:8',
            'confirm_password' => 'required|max:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|',
        ]);
        $curentPassword = Auth::user()->password;
        if (!Hash::check($request->curent_password, $curentPassword)) {
            return redirect()->back()->with('error', __('The password is incorrect'));
        } elseif ($request->new_password !== $request->confirm_password) {
            return redirect()->back()->with('error', __('Passwords do not match'));
        } else {
            $s->update([
                'password' => $request->new_password
            ], Auth::id());
            return redirect()->back();
        }
    }
    public function resetPassword(ResetPasswordRequest $request, StudentRepositoryInterface $s)
    {
        $student = $s->myModel()->where('email', $request->email)->first();


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
            $s->update([
                'password' => $request->new_password
            ], $student->id);

            if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->new_password])) {
                return redirect()->intended(RouteServiceProvider::STUDENT);
            }
        }
    }
}
