<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolData;
use App\Http\Requests\SchoolDataRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class SchoolDataController extends Controller
{
    public function index()
    {
        $school_data = SchoolData::first();
        return view('admin_dashboard.pages.school_data.index',compact('school_data'));
    }

    public function update(SchoolDataRequest $request)
    {
        if(!isset($request->logo))
        {
            $school = SchoolData::find($request->id);
            $school->update($request->all());
            toastr()->success(__('Data updated successfully'));
            return redirect()->back();
        }else{
            
            File::deleteDirectory('images');//delete old logo with directory
            $photo = $request->logo->getClientOriginalExtension();
            $name = time() . Str::random(6) . '.' . $photo;
            $request->logo->storeAs('images/', $name, 'attachments');//save logo in image folder

            $school = SchoolData::find($request->id);//save in database
            $school->update(['logo' => $name]+$request->all());
            toastr()->success(__('Data updated successfully'));
            return redirect()->back();
        }
    }
}
