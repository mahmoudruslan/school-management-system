<?php

namespace App\Http\Controllers\Admin;

use App\Traits\SaveImgTrait;
use App\Http\Controllers\Controller;
use App\models\SchoolData;
use App\models\Student;
use App\repositories\GraduatedRepositoryInterface;
use App\repositories\StudentAccountRepositoryInterface;
use App\repositories\StudentRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use SaveImgTrait;

    public function admin(GraduatedRepositoryInterface $g,StudentAccountRepositoryInterface $s_a, StudentRepositoryInterface $student)
    {
        $g_count = $g->getData()->count();
        $school = SchoolData::all('name_ar','name_en');
        
        $sum = 0;
        for($i = 1; $i <= $student->myModel()->count(); $i++)
        {
            $debit = $student->getById($i)->StudentAccount->sum('debit');
            $credit = $student->getById($i)->StudentAccount->sum('credit');
            if($debit > $credit)
            {
                $sum += 1;
            }
            
            
        }
        return view('admin_dashboard.admin',compact('g_count','school','sum'));
        
    }


}
