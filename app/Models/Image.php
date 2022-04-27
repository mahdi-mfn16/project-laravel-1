<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'name', 'path', 'blog_id', 
    ]; 

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    
}
