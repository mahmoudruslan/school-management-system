<?php
namespace App\repositories;

interface SubjectsRepositoryInterface{
    public function getData($columns='*'):object;
    public function create(array $attributes);

}