<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'David',
            'surname' => 'Romero',
            'email' => 'user@user.com',
            'password' => Hash::make('user'),
            'id' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'David',
            'surname' => 'Romero',
            'email' => 'reviewer@reviewer.com',
            'password' => Hash::make('reviewer'),
            'id' => 2
        ]);

        DB::table('role_user')->insert([
            'role_id' => 3,
            'user_id' => 2,
        ]);
    }
}
