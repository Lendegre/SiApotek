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
        Schema::create('purchase_product', function (Blueprint $table) {
            $table->id('purchase_product_id');
            $table->foreignId('barang_id')->constrained('barang', 'barang_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('purchase_id')->constrained('purchase', 'purchase_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('jumlah');
            $table->integer('isi');
            $table->foreignId('satuan_id')->constrained('satuan', 'satuan_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('bentuk_id')->constrained('bentuk', 'bentuk_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_product');
    }
};
