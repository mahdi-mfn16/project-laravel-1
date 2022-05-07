<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;


class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        return $this->model->all();
    }

    // public function can($name , $user , $id=Blog::class)
    // {
    //     if ($id === Blog::class){
            
    //         return $user->can($name , Blog::class);
    //     }
        
    //     return $user->can($name , $this->model->find($id));
    // }

    public function paginate($count, $privilege = 0, $user = null)
    { 
        if($privilege){
            return $this->model->where('privilege', $privilege)->where('id', '!=', $user->id)->paginate($count);
        }
        return $this->model->where('privilege', $privilege)->paginate($count);
    }

    // public function hasPermission($user, $permissionLabel)
    // {
    //     $user_permissions=[];
    //     $permissions = $this->model->find($user->id)->permissions()->get();
    //     foreach($permissions as $permission){
    //         array_push($user_permissions, $permission->label);
    //     }
    //     return in_array($permissionLabel, $user_permissions);
        
    // }

    

    
    

}