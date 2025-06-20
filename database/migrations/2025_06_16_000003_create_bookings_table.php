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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('id_booking');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Mengubah nama kolom tanggal agar konsisten dengan model/controller
            $table->date('tanggal_booking');
            $table->date('tanggal_kembali');
            $table->decimal('total_harga', 10, 2);
            // Mengubah tipe kolom dari enum menjadi string dengan panjang yang cukup
            $table->string('status_booking', 25)->default('diproses'); // Meningkatkan panjang untuk keamanan
            $table->string('status_sewa', 25)->default('belum_disewa'); // Meningkatkan panjang dan default ke konstanta baru
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

