<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Image;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    public function __construct(Image $model)
    {
        parent::__construct($model);
    }

    public function upload($images , $blog)
    {
        
        foreach($images as $image) {

            $name = $image->getClientOriginalName();
            $path = $image->storeAs('images', $name, 'public');

            $this->model->create([
                'name' => $name,
                'path' => '/storage/'.$path,
                'blog_id'=>$blog->id,
              ]);
        }
    }



    
}