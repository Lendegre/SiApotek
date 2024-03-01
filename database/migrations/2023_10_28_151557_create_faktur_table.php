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
        Schema::create('faktur', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_id')->constrained('purchase', 'purchase_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('purchase_product_id')->constrained('purchase_product', 'purchase_product_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('barang_id')->constrained('barang', 'barang_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('no_faktur');
            $table->string('image');
            $table->date('tgl_trm');
            $table->date('tgl_tempo');  
            $table->enum('sbayar', ['COD', 'Kredit']);
            $table->string('jumlah_trm');  
            $table->string('h_beli');  
            $table->string('total');
            $table->string('g_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faktur');
    }
};
