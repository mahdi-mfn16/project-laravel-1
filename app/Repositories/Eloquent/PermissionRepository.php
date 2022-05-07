<?php

namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;


class PermissionRepository extends BaseRepository implements permissionRepositoryInterface
{
    
    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getByLabel($label)
    {
        return $this->model->where('label', $label)->first();
    }

    // public function can($name , $user , $id=Blog::class)
    // {
    //     if ($id === Blog::class){
            
    //         return $user->can($name , Blog::class);
    //     }
        
    //     return $user->can($name , $this->model->find($id));
    // }

    // public function paginate($count, $privilege = 0)
    // { 
    //     return $this->model->where('privilege', $privilege)->paginate($count);
    // }

    

    
    

}