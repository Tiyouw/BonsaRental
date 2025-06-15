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
        Schema::create('detail_bookings', function (Blueprint $table) {
            $table->id('id_detail_booking');
            $table->unsignedBigInteger('id_booking');
            $table->unsignedBigInteger('id_produk');
            $table->integer('jumlah');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();

            $table->foreign('id_booking')
                  ->references('id_booking')
                  ->on('bookings')
                  ->onDelete('cascade');
            
            $table->foreign('id_produk')
                  ->references('id_produk')
                  ->on('produk')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('detail_bookings');
    }
};
