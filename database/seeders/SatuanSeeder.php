<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('satuan')->insert([
            ['satuan_barang' => 'TUBE'],
            ['satuan_barang' => 'KARTON'],
            ['satuan_barang' => 'BOTOL'],
            ['satuan_barang' => 'BOX'],
            ['satuan_barang' => 'DUS'],
            ['satuan_barang' => 'PACK'],
        ]);
    }
}
