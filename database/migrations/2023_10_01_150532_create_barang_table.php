<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('barang_id');
            $table->string('nama_barang');
            $table->foreignId('supplier_id')->constrained('supplier', 'supplier_id');
            $table->date('tanggal_kedaluwarsa');
            $table->date('tanggal_masuk');
            $table->integer('jumlah');
            $table->foreignId('satuan_id')->constrained('satuan', 'satuan_id');
            $table->integer('isi');
            $table->foreignId('bentuk_id')->constrained('bentuk', 'bentuk_id');
            $table->bigInteger('harga_beli');
            $table->bigInteger('harga_jual');
            $table->integer('stok');
            $table->integer('minimal_stok');
            $table->foreignId('kategori_id')->constrained('kategori', 'kategori_id');
            $table->foreignId('golongan_id')->constrained('golongan', 'golongan_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
