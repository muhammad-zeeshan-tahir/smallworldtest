<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' =>  Str::uuid(),
            'name' => 'User1',
            'email' => 'user1@email.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'id' =>  Str::uuid(),
            'name' => 'user2',
            'email' => 'user2@email.com',
            'password' => bcrypt('password'),
        ]);
    }
}
