<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\models\Admin;
use App\repositories\SubjectRepositoryInterface;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    use GeneralTrait;
    public function index(SubjectRepositoryInterface $s)
    {
        $subjects = $s->getData(['name_'. app()->getLocale() . ' as name','id', 'grade_id', 'classroom_id', 'degree']);
        return response()->json($this->returnData('subjects', $subjects, 'success'));

    }

    public function getById(Request $request, SubjectRepositoryInterface $s)
    {
        $subject = $s->myModel()->select('name_'. app()->getLocale() . ' as name','id', 'grade_id', 'classroom_id', 'degree')->find($request->id);

        if(!$subject)
        {
            return response()->json($this->returnerror('404', __('Item not found')));
        }
        return response()->json($this->returnData('subject', $subject));

    }

    public function adminData(){
        return response()->json($this->returnData('admin', Admin::all()));
    }
}
