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
        Schema::create('penyewaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key ke tabel users
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');

            $table->date('tanggal_mulai_sewa');
            $table->date('tanggal_selesai_sewa');
            $table->integer('durasi_hari'); // Untuk memudahkan perhitungan
            $table->decimal('total_harga', 10, 2);

            $table->enum('status', [
                'menunggu_pembayaran',
                'menunggu_konfirmasi_admin',
                'dikonfirmasi',
                'sedang_disewa',
                'selesai',
                'dibatalkan'
            ])->default('menunggu_pembayaran');

            $table->string('bukti_transfer_path')->nullable(); // Path file bukti transfer
            $table->text('catatan_admin')->nullable(); // Untuk catatan admin terkait penyewaan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaan');
    }
};
