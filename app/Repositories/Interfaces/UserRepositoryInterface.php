<?php

namespace App\Repositories\Interfaces;



interface UserRepositoryInterface
{

    public function all();

    // public function can($name , $user , $id=null);

    public function paginate($count, $privilege = 0, $user = null);

    // public function hasPermission($user, $permissionLabel);
    

    

}