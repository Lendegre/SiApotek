<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BentukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bentuk')->insert([
            ['nama_bentuk' => 'TABLET',],
            ['nama_bentuk' => 'SIRUP KERING',],
            ['nama_bentuk' => 'SIRUP',],
            ['nama_bentuk' => 'SALEP',],
            ['nama_bentuk' => 'KAPLET',],
            ['nama_bentuk' => 'BUBUK',],
        ]);
    }
}
