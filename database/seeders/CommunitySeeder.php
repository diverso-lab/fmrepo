<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('communities')->insert([
            'name' => 'DiversoLab',
            'organisation' => 'Universidad de Sevilla',
            'info' => 'Bla bla bla',
            'id' => 1
        ]);

        DB::table('communities')->insert([
            'name' => 'Quantum mechanics',
            'organisation' => 'Universidad de Sevilla',
            'info' => 'Bla bla bla',
            'id' => 2
        ]);

        DB::table('communityadmins')->insert([
            'user_id' => 1,
            'id' => 1
        ]);

        DB::table('communityadmin_community')->insert([
            'community_admin_id' => 1,
            'community_id' => 1,
        ]);

        DB::table('communityadmin_community')->insert([
            'community_admin_id' => 1,
            'community_id' => 2,
        ]);
    }
}
