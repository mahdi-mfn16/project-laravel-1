<?php

use App\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        if(!Blog::find(1)){
            factory(Blog::class,40)->create();
        }
        
        
    }
}
