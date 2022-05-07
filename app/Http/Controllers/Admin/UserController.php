<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
       $this->userRepository = $userRepository; 
    }

    public function index(Request $request)
    {
        if(! $request->user()->hasPermission('user_view')){
           
            alert()->error("You Don't Have Permission to View Users!",'Error');
            return redirect(route('admin-dashboard'));
            
        }

        $users = $this->userRepository->paginate(5 , $privilege = 0);
        return view('admin.users.index' , ['users'=>$users]);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(! $request->user()->hasPermission('user_create')){
           
            alert()->error("You Don't Have Permission to Create Users!",'Error');
            return redirect(route('index-user'));
            
        }

        return view('admin.users.create');
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        if(! $request->user()->hasPermission('user_create')){
           
            alert()->error("You Don't Have Permission to Create Users!",'Error');
            return redirect(route('index-user'));
            
        }
  
        $data = $request->validated();
        $this->userRepository->create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['email']),
            'created_by_user'=>$request->user()->id,
        ]);

        alert()->success('Your User was Created Successfully!','Success');

        return redirect(route('index-user'));
    }

    





    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $userId)
    {
        
        if(! $request->user()->hasPermission('user_edit')){
           
            alert()->error("You Don't Have Permission to Edit Users!",'Error');
            return redirect(route('index-user'));
            
        }

        $user = $this->userRepository->findById($userId);

        return view('admin.users.edit' , ['user'=>$user]);
    }






    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $userId)
    {

        if(! $request->user()->hasPermission('user_edit')){
           
            alert()->error("You Don't Have Permission to Update Users!",'Error');
            return redirect(route('index-user'));
            
        }

        $data = $request->validated();
        
        $dataArray = [
            'name'=>$data['name'],
            'email'=>$data['email'],
        ];
        if($data['password']){
            $dataArray['password'] = bcrypt($data['password']);
        }

        $this->userRepository->update($dataArray , $userId);
        
         
        alert()->success('Your User was Updated Successfully!','Success'); 
        return redirect(route('index-user'));

    }






   
    public function destroy(Request $request , $userId)
    {
        
        if(! $request->user()->hasPermission('user_delete')){
           
            alert()->error("You Don't Have Permission to Delete Users!",'Error');
            return redirect(route('index-user'));
            
        }
            
        $this->userRepository->delete($userId);
        alert()->success('this User has Deleted Successfully!','Success'); 
        return redirect(route('index-user'));
    }
}
