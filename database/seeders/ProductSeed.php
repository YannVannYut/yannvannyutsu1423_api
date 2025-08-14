<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product')->truncate();

        DB::table('product')->insert(
            [
                [
                    'name' => 'Coca',
                    'cost' => 0.25,
                    'price' => 0.5,
                    'category_id'=> '1',
                ],
                [
                    'name' => 'Hanuman',
                    'cost' => 0.75,
                    'price' => 1.5,
                    'category_id'=> '2',
                ],
                [
                    'name' => 'Gatsby',
                    'cost' => 1,
                    'price' => 10,
                    'category_id'=> '3',
                ]
            ]
        );
    }
}
