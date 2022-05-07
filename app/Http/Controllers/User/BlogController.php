<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Repositories\Eloquent\BlogRepository;
use Illuminate\Http\Request;
use App\Services\BlogService;

use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     private $blogService;
    

     
    

     public function __construct(BlogService $blogService)
     {
         $this->blogService = $blogService;
         

     }

    
    public function index(Request $request)
    {
        $blogs = $this->blogService->blogRepository->paginate(5, Auth::id());
        return view('user.blogs.index', ['blogs'=>$blogs]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.blogs.create');
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
 
  
        $this->blogService->store($request);
        

        alert()->success('Your Blog was Created Successfully!','Success');

        return redirect(route('index'));
    }

    





    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $blogId)
    {
        if(!$this->blogService->blogRepository->can('update' , $request->user(), $blogId)){
            alert()->error("You Don't Have Permission to Edit this Blog!",'Error');
            return redirect(route('index'));
        }

        $blog = $this->blogService->blogRepository->findById($blogId);
        $images = $blog->images;

        
        return view('user.blogs.edit' , ['blog'=>$blog , 'images'=>$images]);
    }






    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, $blogId)
    {
        if(!$this->blogService->blogRepository->can('update' , $request->user(), $blogId)){
            alert()->error("You Don't Have Permission to Edit this Blog!",'Error');
            return redirect(route('index'));
        }

        $this->blogService->update($request, $blogId);
        
         
        alert()->success('Your Blog was Updated Successfully!','Success'); 
        return redirect(route('index'));

    }






    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $blogId)
    {
        
        if($this->blogService->blogRepository->can('delete' , $request->user(), $blogId)){
            alert()->success('Your Blog was Deleted Successfully!','Success'); 
            $this->blogService->delete($blogId);

        }else{
            alert()->error("You Don't Have Permission to Delete this Blog!",'Error');
        }
        
        return redirect(route('index'));
    }
}

