<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // factory(User::class,3)->create();
        User::updateOrCreate(
            ['name' => 'ali'],
            [
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('12345678'),
            // 'email_verified_at' => now(),
            // 'remember_token' => Str::random(10),
            'privilege'=>0,
            ]
        );
        User::updateOrCreate(
            ['name' => 'mehdi'],
            [
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('12345678'),
            // 'email_verified_at' => now(),
            // 'remember_token' => Str::random(10),
            'privilege'=>0,
            ]
        );
        User::updateOrCreate(
            ['name' => 'mohammad'],
            [
            'email' => Str::random(10).'@gmail.com',
            'password' => bcrypt('12345678'),
            // 'email_verified_at' => now(),
            // 'remember_token' => Str::random(10),
            'privilege'=>1,
            ]
        );
        
        
    }
}
