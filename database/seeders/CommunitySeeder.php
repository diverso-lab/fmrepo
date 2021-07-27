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

        DB::table('admincommunities')->insert([
            'community_id' => 1,
            'user_id' => 1,
        ]);
    }
}
