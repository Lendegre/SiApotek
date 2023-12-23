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
            ['nama_kategori' => 'Obat Generik',],
            ['nama_kategori' => 'Alat Kesehatan',],
            ['nama_kategori' => 'OTC(Over The Counter)',],
            ['nama_kategori' => 'Kosmetik',],
            ['nama_kategori' => 'Minuman Bayi',],
            ['nama_kategori' => 'Makanan Bayi',],
            ['nama_kategori' => 'Obat Herbal',],
            ['nama_kategori' => 'Obat Bebas Berstandar',],
            ['nama_kategori' => 'Obat Etikal',],
            ['nama_kategori' => 'Perlengkapan Bayi',],
        ]);
    }
}
