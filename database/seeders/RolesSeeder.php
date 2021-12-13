<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role' => 'admin',
        ]);
        DB::table('roles')->insert([
            'role' => 'user'
        ]);
        DB::table('users')->insert([
            'username' => 'admin',
            'f_name' => 'Matt',
            'l_name' => 'Admin',
            'password' => Hash::make('password'),
            'email' => 'info@jerseyswaponline.com',
            'role_id' => 1
        ]);
    }
}
