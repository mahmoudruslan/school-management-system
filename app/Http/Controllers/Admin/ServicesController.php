<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositories\ClassroomRepositoryInterface;
use App\repositories\GradeRepositoryInterface;
use App\repositories\SectionRepositoryInterface;
use App\Traits\SaveImgTrait;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ServicesController extends Controller
{
    use SaveImgTrait;
    private $lang;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale();
    }
    public function getClassrooms($id, GradeRepositoryInterface $grade) //related ajax code
    {
        // $list_classes = $classroom->all([])->where("grade_id", $id)->pluck("name_" . LaravelLocalization::getCurrentLocale(), "id");
        $grade = $grade->getById($id);
        $list_classes = $grade->classrooms->pluck("name_" . $this->lang, "id");
        return $list_classes;
    }


    public function getSections($id, ClassroomRepositoryInterface $classroom) //related ajax code
    {
        $classroom = $classroom->getById($id);
        $list_sections = $classroom->sections->pluck("name_" . $this->lang, "id");
        // $list_sections = $s->getData()->where("classroom_id", $id)->pluck("name_" . LaravelLocalization::getCurrentLocale(), "id");
        return $list_sections;
    }

        //save parents and students attachment
        public function saveAttachments(Request $request,$id)
        {
                $this->saveimg('attachments/'.$request->model .'s/'. $request->name_ar, $id, 'App\Models\\'.$request->model, $request->photos);
                toastr()->success(__('Data saved successfully'));
                return redirect()->back();
        }
    
        //delete parents and students attachment
        public function deleteAttachments(Request $request,$id)
        {
                $this->deleteFiles($request->model.'s/'.$request->name_ar,$request->filename,$id);
                toastr()->success(__('Deleted successfully'));
                return redirect()->back();
        }
}
