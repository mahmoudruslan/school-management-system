<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentsRequest;
use App\models\Image;
use App\models\Student;
use App\repositories\Eloquent\SectionsRepository;
use App\repositories\StudentsRepositoryInterface;
use App\Traits\SaveImgTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use function PHPUnit\Framework\directoryExists;

class StudentsController extends Controller
{
    use SaveImgTrait;
    private $student;
    public function __construct(StudentsRepositoryInterface $student)
    {
        $this->student = $student;
    }


    public function index()
    {
        $students = $this->student->getAll();
        return view('pages.students.students',compact('students'));
    }



    public function create()
    {
        $data = $this->student->getData();
        return view('pages.students.create',compact(['data']));
    }


    

    public function store(StudentsRequest $request)
    {
        try{
            $student = $this->student->create($request->only('name_ar', 'name_en', 'email' , 'password', 'nationality_id',
            'blood_type_id', 'date_of_birth', 'religion_id', 'grade_id', 'classroom_id', 'section_id', 'parent_id',
            'academic_year', 'gender','address','entry_status'));

                //trait save images
            if (!empty($request->photos)) {//Check if the parent has attachments
                $this->saveimg('attachments/students/' . $request->name_ar, $student->id, 'App\models\Student', $request->photos);
            }
            toastr()->success(__('success'));
            return redirect()->back();
        }catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }




    public function show($id)
    {
//        $post = Student::find(5);
//            return  $post->images ;
        $student = $this->student->getById($id);
        return view('pages.students.show',compact('student'));
    }




    public function edit(Request $request)
    {
        $student = $this->student->getById($request->id);
        $data = $this->student->getData();
        return view('pages.students.edit',compact(['data','student']));
    }



    public function update(StudentsRequest $request)
    {

        try {
        $this->student->update($request->only('name_ar', 'name_en', 'email' , 'password', 'nationality_id',
            'blood_type_id', 'date_of_birth', 'religion_id', 'grade_id', 'classroom_id', 'section_id', 'parent_id',
            'academic_year', 'gender','address','entry_status'),$request->id);

        toastr()->success(__('success'));
        return redirect()->back();
        }catch(\Exception $e)
            {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
    }



    public function destroy(Request $request)
    {
        try {

            $student = $this->student->getById($request->id);
            $directory_path = 'attachments/students/'.$student->name_ar;
            $this->deleteDirectory($directory_path,$request->id);//look save image trait
            $this->student->destroy($request->id);
            toastr()->success(__('Deleted successfully'));
            return redirect()->back();
        }catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function saveAttachments(Request $request)
    {
        try {
            $this->saveimg('attachments/students/' . $request->name_ar, $request->id, 'App\models\Student', $request->photos);
            toastr()->success(__('success'));
            return redirect()->back();
        }catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }


    public function deleteAttachments(Request $request):RedirectResponse
    {
        try{

            $this->deleteFiles('students/'.$request->student_name,$request->filename,$request->id);
            toastr()->success(__('Deleted successfully'));
            return redirect()->back();
        }catch (\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }

    }

    public function getSections($id,SectionsRepository $s)//related ajax code
    {
        $list_sections = $s->getAll()->where("classroom_id", $id)->pluck("name_".LaravelLocalization::getCurrentLocale(), "id");
        return $list_sections;
    }
}
