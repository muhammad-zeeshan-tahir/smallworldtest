<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' =>  Str::uuid(),
            'name' => 'test',
            'email' => 'test@email.com',
            'password' => bcrypt('testPassword'),
        ]);
    }
}
