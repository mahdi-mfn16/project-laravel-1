<?php

namespace App\Repositories\Interfaces;



interface ImageRepositoryInterface
{

    public function upload($images , $blogId);
    public function destroy($images);

}