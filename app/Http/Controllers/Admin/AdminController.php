<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public $adminService;
    public $adminRepository;

    public function __construct(AdminService $adminService, UserRepositoryInterface $adminRepository)
    {
      
       $this->adminService = $adminService;
       $this->adminRepository = $adminRepository;
    }

    public function index(Request $request)
    {
        if(! $request->user()->hasPermission('admin_view')){
           
            alert()->error("You Don't Have Permission to View Admins!",'Error');
            return redirect(route('admin-dashboard'));

        }

        $admins = $this->adminRepository->paginate(5 , $privilege = 1, $request->user());
        return view('admin.admins.index' , ['admins'=>$admins]);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(! $request->user()->hasPermission('admin_create')){
           
            alert()->error("You Don't Have Permission to Create Admins!",'Error');
            return redirect(route('index-admin'));
            
        }

        $permissions = $this->adminService->permissionList();
        
        return view('admin.admins.create',['permissions' => $permissions]);
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        if(! $request->user()->hasPermission('admin_create')){
           
            alert()->error("You Don't Have Permission to Create Admins!",'Error');
            return redirect(route('index-admin'));
            
        }
  
        $this->adminService->store($request);    

        alert()->success('Your Admin was Created Successfully!','Success');
        return redirect(route('index-admin'));
    }

    





    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $adminId)
    {
        if(! $request->user()->hasPermission('admin_edit')){
           
            alert()->error("You Don't Have Permission to Update Admins!",'Error');
            return redirect(route('index-admin'));
            
        }

        

        $admin = $this->adminRepository->findById($adminId);

        if(! $request->user()->can('update', $admin)){
            alert()->error("You Don't Have Permission to Update Yourself!",'Error');
            return redirect(route('index-admin'));
        }

        $permissions = $this->adminService->permissionList();
        $admin_permissions = [];
        foreach($admin->permissions()->get() as $permission){
            array_push($admin_permissions, $permission->label);
        }
        
        return view('admin.admins.edit' , ['admin'=>$admin , 'permissions'=>$permissions, 'admin_permissions'=>$admin_permissions]);
    }






    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, $adminId)
    {
        if(! $request->user()->hasPermission('admin_edit')){
           
            alert()->error("You Don't Have Permission to Update Admins!",'Error');
            return redirect(route('index-admin'));
            
        }

        $this->adminService->update($request, $adminId);
         
        alert()->success('Your Admin was Updated Successfully!','Success'); 
        return redirect(route('index-admin'));

    }






   
    public function destroy(Request $request , $adminId)
    {      
        
        if(! $request->user()->hasPermission('admin_delete')){
           
            alert()->error("You Don't Have Permission to Delete Admins!",'Error');
            return redirect(route('index-admin'));
            
        }

        $admin = $this->adminRepository->findById($adminId);
        if(! $request->user()->can('delete', $admin)){
            alert()->error("You Don't Have Permission to Delete Yourself!",'Error');
            return redirect(route('index-admin'));
        }

        $this->adminRepository->delete($adminId);
        alert()->success('this Admin has Deleted Successfully!','Success'); 
        
        return redirect(route('index-admin'));
    }
}
