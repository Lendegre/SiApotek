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
            // $table->foreignId('barang_id')->constrained('barang', 'barang_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('barang_id')->constrained('barang', 'barang_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('purchase_id')->constrained('purchase', 'purchase_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('satuan_beli');
            $table->string('bentuk');
            $table->string('isi');
            $table->integer('jumlah');
            $table->string('zat')->nullable();
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
