<?php

namespace App\Repositories\Interfaces;



interface ImageRepositoryInterface
{

    public function upload($images , $blog);
    public function destroy($images);

}