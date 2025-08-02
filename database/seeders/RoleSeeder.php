<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('role')->insert([
            ['id' => 1, 'name' => 'Kwarcab'],
            ['id' => 2, 'name' => 'Kwarran'],
            ['id' => 3, 'name' => 'Gudep'],
        ]);
    }

}
