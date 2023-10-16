<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username'      => 'Pemilik',
                'password'      => Hash::make('123pemilik456'),
                'role'          => 'pemilik',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'username'      => 'Apoteker',
                'password'      => Hash::make('123apoteker456'),
                'role'          => 'apoteker',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'username'      => 'Admin',
                'password'      => Hash::make('123admin456'),
                'role'          => 'admin',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
