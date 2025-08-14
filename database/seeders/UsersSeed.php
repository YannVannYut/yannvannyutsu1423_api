<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        DB::table('users')->insert(
            [
                [
                    
                    'name' => 'admin',
                    'email' => 'admin123@gmail.com',
                    'password'=> Hash::make('12345678'),
                    'staff_id'=>1,
                ],
                [
                    
                    'name' => 'sale',
                    'email' => 'sale444@gmail.com',
                    'password'=> Hash::make('12345678'),
                    'staff_id'=>2,
                ]
            ]
        );
    }
}
