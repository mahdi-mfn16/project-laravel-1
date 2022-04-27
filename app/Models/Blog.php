<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Verta;

class Blog extends Model
{
    use SoftDeletes;
    

    

    protected $fillable = [
        'title', 'description', 'status' , 'body', 'user_id',
    ]; 


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function garegorian2jalali($time){
        $v = new Verta($time);
        return $v;
    }
}
