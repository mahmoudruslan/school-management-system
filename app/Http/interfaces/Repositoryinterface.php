<?php

namespace App\Http\interfaces;

interface Repositoryinterface
{
    public function index();
    public function create();
    public function update(arry $data, $id);
    public function show($id);
    public function delete( $id);

}
