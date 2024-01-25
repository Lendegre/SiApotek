<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('supplier')->insert([
            [
                'nama_supplier' => 'PT Combi Putra',
                'nama_sales'    => 'Kristian',
                'no_telp'       => '085314200125',
                'alamat'        => 'Bandung'
            ],
            [
                'nama_supplier' => 'PT Antarmitra Sembada',
                'nama_sales'    => 'Hendrik',
                'no_telp'       => '083120100007',
                'alamat'        => 'Cirebon'
            ],
            [
                'nama_supplier' => 'Kimia Farma',
                'nama_sales'    => 'Iqbal',
                'no_telp'       => '082240197573',
                'alamat'        => 'Bandung'
            ],
            [
                'nama_supplier' => 'PT Praba Baraka Jaya',
                'nama_sales'    => 'Rian Mahendra',
                'no_telp'       => '085317749189',
                'alamat'        => 'Cirebon'
            ],
            [
                'nama_supplier' => 'PT Prisma Surya Gemilang',
                'nama_sales'    => 'Rian',
                'no_telp'       => '087783976091',
                'alamat'        => 'Ciamis'
            ],
            [
                'nama_supplier' => 'Kimia Farma',
                'nama_sales'    => 'Arif Mawardi',
                'no_telp'       => '02652354848',
                'alamat'        => 'Tasikmalaya'
            ],
        ]);
    }
}
