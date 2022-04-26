<?php

namespace App\Services;



class UpdateBlogService
{
    public $blogRepository;
    public $imageRepository;

    public function __construct($blogRepository,  $imageRepository)
     {
         $this->blogRepository = $blogRepository;
         $this->imageRepository = $imageRepository;

     }

    public function update($request,$blogId)
    {

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
        
    }



    
}