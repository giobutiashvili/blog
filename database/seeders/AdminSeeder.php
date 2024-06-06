<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([[
            'name'=> 'გიორგი',
            'email'=> 'admin@admin.com',
            'password'=> Hash::make('admin123'),]
        ]);
    }
}
