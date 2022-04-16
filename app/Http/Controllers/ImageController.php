<?php

namespace App\Http\Controllers;


use App\Image;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ImageRepositoryInterface;

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
        $image->delete();
        $images = $blog->images;
        return response()->json(['images'=>json_encode($images,true)]);

    }

    
}
