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
                'nama_supplier' => 'PT COMBI PUTRA',
                'nama_sales'    => 'KRISTIAN',
                'no_telp'       => '085314200125',
                'alamat'        => 'BANDUNG'
            ],
            [
                'nama_supplier' => 'PT ANTARMITRA SEMBADA',
                'nama_sales'    => 'HEDNRIK',
                'no_telp'       => '083120100007',
                'alamat'        => 'CIREBON'
            ],
            [
                'nama_supplier' => 'KIMIA FARMA',
                'nama_sales'    => 'IQBAL',
                'no_telp'       => '082240197573',
                'alamat'        => 'BANDUNG'
            ],
            [
                'nama_supplier' => 'PT PRABA BARAKA JAYA',
                'nama_sales'    => 'RIAN MAHENDRA',
                'no_telp'       => '085317749189',
                'alamat'        => 'Cirebon'
            ],
            [
                'nama_supplier' => 'PT PRISMA SURYA GEMILANG',
                'nama_sales'    => 'RIAN',
                'no_telp'       => '087783976091',
                'alamat'        => 'CIAMIS'
            ],
            [
                'nama_supplier' => 'KIMIA FARMA',
                'nama_sales'    => 'ARIF MAWARDI',
                'no_telp'       => '02652354848',
                'alamat'        => 'TASIKMALAYA'
            ],
        ]);
    }
}
