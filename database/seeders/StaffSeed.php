<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('staff')->truncate();

        DB::table('staff')->insert(
            [
                [
                    'position_id' => '1',
                    'name' => 'admin',
                    'gender' => 'male',
                    'dob' => '2005-12-12',
                    'pob'=> 'PhnomPenh',
                    'address'=> 'PhnomPenh',
                    'phone'=> '011 122 333',
                    'nation_id_card'=> '1212121212121',
                ],
                [
                    'position_id' => '2',
                    'name' => 'sale',
                    'gender' => 'male',
                    'dob' => '2000-01-12',
                    'pob'=> 'PhnomPenh',
                    'address'=> 'PhnomPenh',
                    'phone'=> '012 111 333',
                    'nation_id_card'=> '1010000212121',
                ]
            ]
        );
    }
}
