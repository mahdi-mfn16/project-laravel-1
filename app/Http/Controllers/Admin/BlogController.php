<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBlogRequest;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     private $blogService;
     private $blogRepository;

     public function __construct(BlogService $blogService, BlogRepositoryInterface $blogRepository)
     {
         $this->blogService = $blogService;
         $this->blogRepository = $blogRepository;
     }

    
    public function index(Request $request)
    {

        if(! $request->user()->hasPermission('blog_view')){
           
            alert()->error("You Don't Have Permission to View Blogs!",'Error');
            return redirect(route('admin-dashboard'));
            
        }

        $blogs = $this->blogRepository->paginate(5);

        return view('admin.blogs.index' , ['blogs'=>$blogs]);
    }






    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $blogId)
    {

        if(! $request->user()->hasPermission('blog_edit')){
           
            alert()->error("You Don't Have Permission to Edit Blogs!",'Error');
            return redirect(route('admin-index'));
            
        }

        $blog = $this->blogRepository->findById($blogId);
        $images = $blog->images;

        
        return view('admin.blogs.edit' , ['blog'=>$blog , 'images'=>$images]);
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
        if(! $request->user()->hasPermission('blog_edit')){
           
            alert()->error("You Don't Have Permission to Edit Blogs!",'Error');
            return redirect(route('admin-index'));
            
        }

        $this->blogService->update($request, $blogId);
        
         
        alert()->success('Your Blog was Updated Successfully!','Success'); 
        return redirect(route('admin-index'));

    }






    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $blogId)
    {

        if(! $request->user()->hasPermission('blog_delete')){
           
            alert()->error("You Don't Have Permission to Delete Blogs!",'Error');
            return redirect(route('admin-index'));
            
        }
        
        $this->blogService->delete($blogId);
        alert()->success('This Blog was Deleted Successfully!','Success'); 
        return redirect(route('admin-index'));
    }

}

