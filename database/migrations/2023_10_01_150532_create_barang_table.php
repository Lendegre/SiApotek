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
            $table->foreignId('supplier_id')->constrained('supplier', 'supplier_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggal_kedaluwarsa')->nullable();
            $table->foreignId('satuan_id')->constrained('satuan', 'satuan_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('isi');
            $table->integer('stok');
            $table->bigInteger('harga_jual');
            $table->string('satuan_jual');
            $table->integer('minimal_stok');
            $table->foreignId('kategori_id')->constrained('kategori', 'kategori_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('bentuk_id');
            $table->foreignId('golongan_id')->constrained('golongan', 'golongan_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggal_masuk')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
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
