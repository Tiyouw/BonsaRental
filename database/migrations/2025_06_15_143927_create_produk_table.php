<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('produk', function (Blueprint $table) {
        $table->id('id_produk');
        $table->string('nama_produk');
        $table->text('deskripsi')->nullable();
        $table->decimal('harga_per_hari', 10, 2);
        $table->integer('stock');
        $table->string('gambar')->nullable();
        $table->unsignedBigInteger('id_kategori');
        $table->timestamps();

        $table->foreign('id_kategori')
              ->references('id_kategori')
              ->on('kategori_produk')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
