<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('position')->truncate();

        DB::table('position')->insert(
            [
                [
                    'branch_id' => '1',
                    'name' => 'admin',
                    'description' => 'use for admin',
                ],
                [
                    'branch_id' => '2',
                    'name' => 'sale',
                    'description' => 'use for sale',
                ]
            ]
        );
    }
}
