<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'rol' => 'RESEARCHER',
            'slug' => 'Researcher',
            'id' => 1
        ]);

        DB::table('roles')->insert([
            'rol' => 'DEVELOPER',
            'slug' => 'Developer',
            'id' => 2
        ]);

        DB::table('roles')->insert([
            'rol' => 'REVIEWER',
            'slug' => 'Reviewer',
            'id' => 3
        ]);
    }
}
