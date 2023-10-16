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
        Schema::create('customer', function (Blueprint $table) {
            $table->id('customer_id');
            $table->string('nama_customer');
            $table->integer('usia');
            $table->string('alamat');
            $table->enum('jenis_obat', ['Resep', 'Non-Resep']);
            $table->enum('status', ['Pending', 'Dibayar']);
            $table->bigInteger('total_harga')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
