<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    public function __construct(Image $model)
    {
        parent::__construct($model);
    }

    public function upload($images, $blog)
    {

        foreach ($images as $image) {

            $name = hash('ripemd160', Str::random(10)) . '_' . $image->getClientOriginalName();

            $path = $image->storeAs('images', $name, 'public_only');

            $this->model->create([
                'name' => $name,
                'path' => '/uploads/' . $path,
                'blog_id' => $blog->id,
            ]);
        }
    }



    public function destroy($images)
    {
        foreach ($images as $image) {
            if (File::exists(public_path($image->path))) {
                File::delete(public_path($image->path));
                $this->delete($image->id);
            }
        }
    }
}
