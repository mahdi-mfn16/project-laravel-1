<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BlogRepositoryInterface;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     private $blogRepository;

     public function __construct(BlogRepositoryInterface $blogRepository)
     {
         $this->blogRepository = $blogRepository;

     }

    
    public function index()
    {
        $blogs = $this->blogRepository->paginate(5);

        return view('admin.blogs.index' , ['blogs'=>$blogs]);
    }

}

