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


    public function permissionList()
    {
        $permissions = $this->permissionRepository->all();
        return $permissions;
    }


    public function store($request)
    {

        $data = $request->validated();

        $user = $this->adminRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'created_by_user' => $request->user()->id,
            'privilege' => 1,

        ]);



        if (isset($data['permissions'])) {

            foreach ($data['permissions'] as $permission) {

                $one_permission = $this->permissionRepository->getByLabel($permission);
                $user->permissions()->attach(
                    $one_permission->id
                );
            }
        }
    }




    public function update($request, $adminId)
    {

        $data = $request->validated();

        $dataArray = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];
        if ($data['password']) {
            $dataArray['password'] = bcrypt($data['password']);
        }

        $this->adminRepository->update($dataArray, $adminId);

        $admin = $this->adminRepository->findById($adminId);
        if (!$request->user()->can('update', $admin)) {
            alert()->error("You Don't Have Permission to Update Yourself!", 'Error');
            return redirect(route('index-admin'));
        }

        if (isset($data['permissions'])) {

            $admin->permissions()->detach();
            foreach ($data['permissions'] as $permission) {
                $one_permission = $this->permissionRepository->getByLabel($permission);

                $admin->permissions()->attach(
                    $one_permission->id
                );
            }
            
        } else {
            $admin->permissions()->detach();
        }
    }
}
