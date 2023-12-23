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
            ['bentuk_barang' => 'Sirup Kering'],
            ['bentuk_barang' => 'Cair'],
            ['bentuk_barang' => 'Sirup'],
            ['bentuk_barang' => 'Kapsul'],
            ['bentuk_barang' => 'Salep'],
            ['bentuk_barang' => 'Tablet'],
            ['bentuk_barang' => 'Kaplet'],
            ['bentuk_barang' => 'Pil'],
            ['bentuk_barang' => 'Puyer'],
            ['bentuk_barang' => 'Gel'],
        ]);
    }
}
