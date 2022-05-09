<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permission_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('permission_user')->insert([
            ['permission_id' => 1, 'user_id'=>3],
            ['permission_id' => 2, 'user_id'=>3],
            ['permission_id' => 3, 'user_id'=>3],
            ['permission_id' => 4, 'user_id'=>3],
            ['permission_id' => 5, 'user_id'=>3],
            ['permission_id' => 6, 'user_id'=>3],
            ['permission_id' => 7, 'user_id'=>3],
            ['permission_id' => 8, 'user_id'=>3],
            ['permission_id' => 9, 'user_id'=>3],
            ['permission_id' => 10, 'user_id'=>3],
            ['permission_id' => 11, 'user_id'=>3],
            
        ]);
    }
}
