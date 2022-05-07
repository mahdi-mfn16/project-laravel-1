<?php

namespace App\Repositories\Interfaces;



interface PermissionRepositoryInterface
{

    public function all();
    
    public function getByLabel($label);

    // public function can($name , $user , $id=null);

    // public function paginate($count, $privilege = 0);
    

    

}