<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     private $blogRepository;
     private $imageRepository;

     public function __construct(BlogRepositoryInterface $blogRepository, ImageRepositoryInterface $imageRepository)
     {
         $this->blogRepository = $blogRepository;
         $this->imageRepository = $imageRepository;

     }

    
    public function index(Request $request)
    {
        $blogs = $this->blogRepository->paginate(5, Auth::id());
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
 
  
        $blog = $this->blogRepository->create([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status,
            'body'=>$request->body,
            'user_id'=>$request->user()->id,
        ]);

        if ($request->hasfile('images')) {
            
            $images = $request->file('images');
            $this->imageRepository->upload($images , $blog);
         }


        alert()->success('Your Blog was Created Successfully!','Success');

        return redirect(route('index'));
    }

    





    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $blogId)
    {
        if(!$this->blogRepository->can('update' , $request->user(), $blogId)){
            alert()->error("You Don't Have Permission to Edit this Blog!",'Error');
            return redirect(route('index'));
        }

        $blog = $this->blogRepository->findById($blogId);
        $images = $blog->images;

        
        return view('user.blogs.edit' , ['blog'=>$blog , 'images'=>$images]);
    }






    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, $blogId)
    {
        if(!$this->blogRepository->can('update' , $request->user(), $blogId)){
            alert()->error("You Don't Have Permission to Edit this Blog!",'Error');
            return redirect(route('index'));
        }

        // return $request;

        
        $this->blogRepository->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status,
            'body'=>$request->body,
           
        ],$blogId);

        $blog = $this->blogRepository->findById($blogId);
    

        if ($request->hasfile('images')) {
            $images = $request->file('images');
            $this->imageRepository->upload($images , $blog);
         }
         
        alert()->success('Your Blog was Updated Successfully!','Success'); 
        return redirect(route('index'));

    }






    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $blogId)
    {
        if($this->blogRepository->can('delete' , $request->user(), $blogId)){
            $this->blogRepository->delete($blogId);
        }else{
            alert()->error("You Don't Have Permission to Delete this Blog!",'Error');
        }
        
        return redirect(route('index'));
    }
}

