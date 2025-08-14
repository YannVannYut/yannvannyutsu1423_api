<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category')->truncate();
        DB::table('category')->insert([
            [
                'name' => 'Drink',
                'description' => 'Ey kor ey tvv',
            ],
            [
                'name' => 'Beer',
                'description' => 'Pherk Sra ',
            ],
            [
                'name' => 'Skincare',
                'description' => 'Beauty',
            ],

        ]);
    }
}
