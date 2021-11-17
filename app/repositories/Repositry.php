<?php

namespace App\repositories;

use App\Http\interfaces\arry;
use App\Http\interfaces\Repositoryinterface;
use App\models\Specialization;
use App\models\Teacher;

class Repositry implements Repositoryinterface
{

    public function index()
    {
        return Teacher::all();
    }

    public function create()
    {
        return Specialization::all();
    }

    public function update(arry $data, $id)
    {
        // TODO: Implement update() method.
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
