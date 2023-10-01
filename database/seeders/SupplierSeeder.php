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
                'nama_supplier' => 'PT Konimex',
                'nama_sales'    => 'Neville',
                'no_telp'       => '082373914639',
                'alamat'        => 'Yogyakarta'
            ],
        ]);
    }
}
