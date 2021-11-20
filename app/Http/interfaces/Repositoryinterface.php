<?php

namespace App\Http\interfaces;

interface Repositoryinterface
{
    public function index();
    public function store($request);
    public function getSpecializations();
    public function edit($id);
    public function update($request);
    public function delete( $request);

}
