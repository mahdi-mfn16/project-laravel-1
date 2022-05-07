<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class AdminService
{
    public $adminRepository;
    public $permissionRepository;

    public function __construct(UserRepositoryInterface $adminRepository, PermissionRepositoryInterface $permissionRepository)
     {
         $this->adminRepository = $adminRepository;
         $this->permissionRepository = $permissionRepository;

     }

    







    
}