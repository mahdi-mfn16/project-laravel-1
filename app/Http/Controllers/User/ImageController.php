<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    private $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }
    
    public function delete(Request $request)
    {
        $imageId = $request->image;
        $image = $this->imageRepository->findById($imageId);
        $blog = $image->blog;
        
        if(File::exists(public_path($image->path))){
            File::delete(public_path($image->path));
            $this->imageRepository->delete($imageId);       
        }
        
        $images = $blog->images;
        return response()->json(['images'=>json_encode($images,true)]);

    }

    
}
