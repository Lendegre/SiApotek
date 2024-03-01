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
                'username'      => 'PEMILIK',
                'password'      => Hash::make('123PEMILIK456'),
                'role'          => 'pemilik',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'username'      => 'APOTEKER',
                'password'      => Hash::make('123APOTEKER456'),
                'role'          => 'apoteker',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'username'      => 'ADMIN',
                'password'      => Hash::make('123ADMIN456'),
                'role'          => 'admin',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
