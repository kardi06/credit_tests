<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            [
                'name'=> 'admin',
                'password'=> bcrypt('admin9876'),
                'email' => 'admin@a.com',
                'role' => 'admin',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ],
            [
                'name'=> 'customer1',
                'password'=> bcrypt('cust123456'),
                'email' => 'customer1@a.com',
                'role' => 'customer',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
