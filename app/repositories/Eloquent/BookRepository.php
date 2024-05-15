<?php
namespace App\repositories\Eloquent;
use App\Models\Book;

class BookRepository extends BasicRepository {


    public function __construct(Book $model)
    {
        parent::__construct($model);
    }
} 