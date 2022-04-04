<?php

namespace App\repositories\Eloquent;

use App\models\Attendance;
use App\repositories\AttendanceRepositoryInterface;

class AttendanceRepository extends BasicRepository implements AttendanceRepositoryInterface
{
    public $model;
    public function __construct(Attendance $model)
    {
        $this->model = $model;
    }

    public function createe(array $x,array $attributes)
    {
        try {
            return $this->model->updateOrCreate($x,$attributes);
            toastr()->success(__('Data saved successfully'));
            return $create;
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


}
