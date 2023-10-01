<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('golongan')->insert([
            ['jenis_golongan' => 'Psikotropika'],
            ['jenis_golongan' => 'Narkotika'],
            ['jenis_golongan' => 'Prekursor'],
            ['jenis_golongan' => 'Reguler'],
        ]);
    }
}
