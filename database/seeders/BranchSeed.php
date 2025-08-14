<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BranchSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branch')->truncate();
        DB::table('branch')->insert([
            'name' => 'FakeMart',
            'location' => 'PhnomPenh',
            'contact_number' => '015 237 312',
        ]);
    }
}
