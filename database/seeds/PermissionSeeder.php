<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        
        if(! Permission::find(1)){
            Permission::insert([
                ['label' => 'blog_view'],
                ['label' => 'blog_edit'],
                ['label' => 'blog_delete'],
                ['label' => 'user_view'],
                ['label' => 'user_create'],
                ['label' => 'user_edit'],
                ['label' => 'user_delete'],
                ['label' => 'admin_view'],
                ['label' => 'admin_create'],
                ['label' => 'admin_edit'],
                ['label' => 'admin_delete'],
                
            ]);
        }
        
    }
}
