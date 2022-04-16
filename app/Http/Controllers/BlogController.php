<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;


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
        $blogs = $request->user()->blogs;
        return view('blogs.index', ['blogs'=>$blogs]);
    }





    public function adminIndex(Request $request)
    {
        if (!$this->blogRepository->can('viewAny', $request->user())) {
           return redirect(route('index'));
        }
        $blogs = $this->blogRepository->all();
        return view('blogs.admin-index' , ['blogs'=>$blogs]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|unique:blogs,title',
            'description'=>'required',
            'status'=>'required|in:1,0',
            'body'=>'required',
        ]);
        
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
            return redirect(back());
        }

        $blog = $this->blogRepository->findById($blogId);
        $images = $blog->images;

        
        return view('blogs.edit' , ['blog'=>$blog , 'images'=>$images]);
    }






    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $blogId)
    {
        if(!$this->blogRepository->can('update' , $request->user(), $blogId)){
            return redirect(back());
        }

        $request->validate([
            'title'=>[
                'required',
                Rule::unique('blogs')->ignore($request->user()->id, 'user_id')
            ],
            'description'=>'required',
            'status'=>'required|in:1,0',
            'body'=>'required',
        ]);
        
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
        }
        return redirect(route('index'));
    }
}
