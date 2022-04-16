<?php

namespace App\Repositories\Interfaces;



interface BlogRepositoryInterface
{

    public function all();

    public function can($name , $user , $id=null);

    

}