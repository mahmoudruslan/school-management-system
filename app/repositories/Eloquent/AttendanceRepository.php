<?php

namespace App\repositories\Eloquent;

use App\Models\Attendance;

class AttendanceRepository extends BasicRepository
{
    public $model;
    public function __construct(Attendance $model)
    {
        $this->model = $model;
    }

    public function createOrup(array $x,array $attributes)
    {
        try {
            $create = $this->model->updateOrCreate($x,$attributes);
            toastr()->success(__('Data saved successfully'));
            return $create;
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


}
