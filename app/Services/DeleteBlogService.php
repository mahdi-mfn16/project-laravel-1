<?php

namespace App\Services;



class DeleteBlogService
{
    public $blogRepository;
    public $imageRepository;

    public function __construct($blogRepository,  $imageRepository)
     {
         $this->blogRepository = $blogRepository;
         $this->imageRepository = $imageRepository;

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