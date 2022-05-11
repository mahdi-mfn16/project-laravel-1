<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Models\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    public function __construct(Image $model)
    {
        parent::__construct($model);
    }

    public function upload($images, $blogId)
    {

        foreach ($images as $image) {

            $name = hash('ripemd160', Str::random(10)) . '_' . $image->getClientOriginalName();

            $path = $image->storeAs('images', $name, 'public_only');

            $this->model->create([
                'name' => $name,
                'path' => '/uploads/' . $path,
                'blog_id' => $blogId,
            ]);
        }
    }



    public function destroy($image)
    {

        
            if (File::exists(public_path($image->path))) {
                File::delete(public_path($image->path));
                $this->delete($image->id);
            }
        
    }
}
