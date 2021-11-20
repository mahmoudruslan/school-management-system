<?php

namespace App\repositories;

use App\Http\interfaces\arry;
use App\Http\interfaces\Repositoryinterface;
use App\models\Specialization;
use App\models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Repositry implements Repositoryinterface
{

    public function index()
    {
        return Teacher::all();
    }


    public function store($request)
    {

        if($request->gender == '$2y$10$NgiCAwLGJ6yMl/ZDlNmBBu07oegjK1JG9VGiRhdMrmI4VmdzuRQQS')
        {
            $request->gender = 'male';
        }elseif ($request->gender == '$2y$10$FkGE1UxATWFSWUuRPxqdu.uccMpntdV6r3662YMA.HDyssiNlJdYa')
        {
            $request->gender = 'female';
        }else{
            return toastr()->error(__('messages.Stop playing in the code'));
        }

        try {
            Teacher::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'address' => $request->address,
                'specialization_id' => $request->specialization_id,
                'joining_date' => $request->joining_date,
                'gender' => $request->gender,

            ]);
            toastr()->success(__('messages.success'));
            return redirect()->route('Teachers.create');


        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }


    public function getSpecializations()
    {
        return Specialization::all();
    }


    public function edit($id)
    {
        return Teacher::find($id);
    }

    public function update($request)
    {

        try {
            $teacher = Teacher::find($request->id);

            if($request->gender == '$2y$10$NgiCAwLGJ6yMl/ZDlNmBBu07oegjK1JG9VGiRhdMrmI4VmdzuRQQS')
            {
                $request->gender = 'male';
            }elseif ($request->gender == '$2y$10$FkGE1UxATWFSWUuRPxqdu.uccMpntdV6r3662YMA.HDyssiNlJdYa')
            {
                $request->gender = 'female';
            }elseif (!$request->gender){
                $request->gender = $teacher->gender;
            } else{
                return toastr()->error(__('messages.Stop playing in the code'));
            }


            if(!$teacher){
                toastr()->error(__('messages.error_section'));
                return redirect()->back();
            }else {
                $teacher->update([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'name_ar' => $request->name_ar,
                    'name_en' => $request->name_en,
                    'address' => $request->address,
                    'specialization_id' => $request->specialization_id,
                    'joining_date' => $request->joining_date,
                    'gender' =>  $request->gender,
                ]);
                toastr()->success(__('messages.success_edit'));
                return redirect()->route('Teachers.index');
            }
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }





    public function delete($request)
    {

        try {
            $teacher = Teacher::find($request->id);
            if(!$teacher){
                toastr()->error(__('messages.error_section'));
                return redirect()->back();
            }else {
                $teacher->delete();
                toastr()->success(__('messages.success_delete'));
                return redirect()->back();
            }

        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
    }
    }
}
