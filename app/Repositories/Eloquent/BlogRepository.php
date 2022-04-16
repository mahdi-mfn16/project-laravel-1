<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Blog;
use Illuminate\Database\Eloquent\Collection;


class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    
    public function __construct(Blog $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function can($name , $user , $id=Blog::class)
    {
        if ($id === Blog::class){
            return $user->can($name , Blog::class);
        }

        return $user->can($name , $this->model->find($id));
    }

    

    
    

}