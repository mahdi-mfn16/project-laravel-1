<?php

namespace App\Services;



class StoreBlogService
{
    public $blogRepository;
    public $imageRepository;

    public function __construct($blogRepository,  $imageRepository)
     {
         $this->blogRepository = $blogRepository;
         $this->imageRepository = $imageRepository;

     }

    public function store($request)
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
        
    }



    
}