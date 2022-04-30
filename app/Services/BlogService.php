<?php

namespace App\Services;

use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;

class BlogService
{
    public $blogRepository;
    public $imageRepository;

    public function __construct(BlogRepositoryInterface $blogRepository, ImageRepositoryInterface $imageRepository)
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



    public function delete($blogId)
    {

            $blog = $this->blogRepository->findById($blogId);
            $this->blogRepository->update([
                'title'=>$blog->title."_deleted_{$blogId}",
                ],$blogId);
            $images = $blog->images;
            
            foreach($images as $image){
                $this->imageRepository->destroy($image);
            }
            
            $this->blogRepository->delete($blogId);
        
    }







    
}