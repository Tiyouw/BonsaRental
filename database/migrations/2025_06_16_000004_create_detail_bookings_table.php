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
        Schema::create('detail_bookings', function (Blueprint $table) {
            $table->id('id_detail_booking');
            $table->foreignId('id_booking')
                  ->constrained('bookings', 'id_booking')
                  ->onDelete('cascade');
            $table->foreignId('id_produk')
                  ->constrained('produks', 'id_produk')
                  ->onDelete('restrict');
            $table->integer('jumlah');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_bookings');
    }
};
