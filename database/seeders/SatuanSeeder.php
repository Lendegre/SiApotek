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
            ['satuan_barang' => 'Tube'],
            ['satuan_barang' => 'Karton'],
            ['satuan_barang' => 'Botol'],
            ['satuan_barang' => 'Box'],
        ]);
    }
}
