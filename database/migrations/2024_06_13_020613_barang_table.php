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
            $table->tinyIncrements('id');
            $table->string('merk', 50)->nullable();
            $table->string('seri', 50)->nullable();
            $table->text('spesifikasi')->nullable();
            $table->unsignedInteger('stok')->default(0);
            $table->string('foto')->nullable();
            $table->unsignedTinyInteger('kategori_id')->nullable();
            $table->timestamps();

            // Menambahkan konstrain foreign key
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('restrict');
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
