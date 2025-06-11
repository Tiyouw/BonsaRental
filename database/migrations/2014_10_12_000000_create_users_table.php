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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // Menggunakan 'name' sebagai kolom utama untuk login (sesuai permintaan "gunakan name")
            $table->string('name')->unique(); // <-- Ubah dari 'username' menjadi 'name'
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // Kolom role dengan tipe enum
            $table->enum('role', ['admin', 'pelanggan'])->default('pelanggan');
            // Kolom tambahan untuk profil pengguna
            $table->string('nama_lengkap')->nullable();
            $table->string('no_telepon')->nullable();
            $table->text('alamat')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
