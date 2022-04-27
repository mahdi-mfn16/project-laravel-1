<?php

namespace App\Repositories\Eloquent;

use App\Models\Blog;
use App\Repositories\Interfaces\BlogRepositoryInterface;


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

    public function paginate($count, $user_id = null)
    {
        if($user_id === null){
            return $this->model->paginate($count);
        }

        return $this->model->where('user_id', $user_id)->paginate($count);
    }

    

    
    

}