<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            ['nama_kategori' => 'OBAT GENERIK',],
            ['nama_kategori' => 'ALAT KESEHATAN',],
            ['nama_kategori' => 'OTC(OVER THE COUNTER)',],
            ['nama_kategori' => 'KOSMETIK',],
            ['nama_kategori' => 'MINUMAN BAYI',],
            ['nama_kategori' => 'MAKANAN BAYI',],
            ['nama_kategori' => 'OBAT HERBAL',],
            ['nama_kategori' => 'OBAT BEBAS BERSTANDAR',],
            ['nama_kategori' => 'OBAT ETIKAL',],
            ['nama_kategori' => 'PERLENGKAPAN BAYI',],
        ]);
    }
}
