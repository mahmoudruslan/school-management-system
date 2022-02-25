<?php
namespace App\repositories\Eloquent;
use App\repositories\BooksRepositoryInterface;
use App\models\Book;

class BooksRepository extends BasicRepository implements BooksRepositoryInterface{

    public function __construct(Book $model)
    {
        parent::__construct($model);
    }
} 