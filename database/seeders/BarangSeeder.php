<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        date_default_timezone_set('Asia/Jakarta');

        DB::table('barang')->insert([
            [
                'nama_barang'           => 'Komix',
                'supplier_id'           => 1,
                'tanggal_kedaluwarsa'   => date('Y-m-d', strtotime('+20 days')),
                'tanggal_masuk'         => now(),
                'jumlah'                => 5,
                'satuan_id'             => 4,
                'isi'                   => 50,
                'bentuk_id'             => 2,
                'harga_beli'            => 500000,
                'harga_jual'            => 5000,
                'minimal_stok'          => 10,
                'kategori_id'           => 1,
                'golongan_id'           => 4,
            ],
            [
                'nama_barang'           => 'Rhinos',
                'supplier_id'           => 1,
                'tanggal_kedaluwarsa'   => date('Y-m-d', strtotime('+20 days')),
                'tanggal_masuk'         => now(),
                'jumlah'                => 3,
                'satuan_id'             => 4,
                'isi'                   => 30,
                'bentuk_id'             => 2,
                'harga_beli'            => 300000,
                'harga_jual'            => 3000,
                'minimal_stok'          => 10,
                'kategori_id'           => 1,
                'golongan_id'           => 4,
            ],
        ]);
    }
}
