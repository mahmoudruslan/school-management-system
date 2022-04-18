<?php
namespace App\repositories\Eloquent;
use App\repositories\BookRepositoryInterface;
use App\Models\Book;

class BookRepository extends BasicRepository implements BookRepositoryInterface{

    //اي فايدة فانكشن الكونستراكت دي؟
    //
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }
} 