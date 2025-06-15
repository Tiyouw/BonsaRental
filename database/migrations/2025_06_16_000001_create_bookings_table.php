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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('id_booking');
            $table->unsignedBigInteger('user_id');
            $table->date('tanggal_booking');
            $table->date('tanggal_kembali');
            $table->decimal('total_harga', 10, 2);
            // Status booking: diproses, disetujui, ditolak
            $table->enum('status_booking', ['diproses', 'disetujui', 'ditolak'])->default('diproses');
            // Status sewa: belum_disewa, disewa, dikembalikan
            $table->enum('status_sewa', ['belum_disewa', 'disewa', 'dikembalikan'])->default('belum_disewa');
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
