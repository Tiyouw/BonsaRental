<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Produk;
use App\Models\Penyewaan;
use Carbon\Carbon;

class PenyewaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('name', 'admin')->first();
        $felixEdna = User::where('name', 'Felix Edna')->first();
        $budiSantoso = User::where('name', 'Budi Santoso')->first();

        $canon60D = Produk::where('nama', 'Canon 60D')->first();
        $canon1855mm = Produk::where('nama', 'Canon 18-55mm')->first();
        $lensa50mm = Produk::where('nama', 'Lensa 50mm f/1.8')->first();
        $lightingKit = Produk::where('nama', 'Lighting Kit Godox')->first();

        if ($admin && $felixEdna && $budiSantoso && $canon60D && $canon1855mm && $lensa50mm && $lightingKit) {
            // Riwayat untuk Dashboard Admin (PageController::dashboard)
            Penyewaan::create([
                'user_id' => $felixEdna->id,
                'produk_id' => $canon60D->id,
                'tanggal_mulai_sewa' => '2024-04-28',
                'tanggal_selesai_sewa' => '2024-04-30',
                'durasi_hari' => 2,
                'total_harga' => $canon60D->harga_per_hari * 2,
                'status' => 'Selesai',
                'bukti_transfer_path' => null,
            ]);

            Penyewaan::create([
                'user_id' => $felixEdna->id,
                'produk_id' => $canon1855mm->id,
                'tanggal_mulai_sewa' => '2024-05-18',
                'tanggal_selesai_sewa' => '2024-05-20',
                'durasi_hari' => 2,
                'total_harga' => $canon1855mm->harga_per_hari * 2,
                'status' => 'Selesai',
                'bukti_transfer_path' => null,
            ]);

            // Riwayat untuk Riwayat Booking Pelanggan (PageController::riwayatBooking)
            Penyewaan::create([
                'user_id' => $budiSantoso->id,
                'produk_id' => $lensa50mm->id,
                'tanggal_mulai_sewa' => '2025-05-15',
                'tanggal_selesai_sewa' => '2025-05-16',
                'durasi_hari' => 1,
                'total_harga' => $lensa50mm->harga_per_hari * 1,
                'status' => 'Selesai',
                'bukti_transfer_path' => null,
            ]);

            Penyewaan::create([
                'user_id' => $budiSantoso->id,
                'produk_id' => $lightingKit->id,
                'tanggal_mulai_sewa' => '2025-05-10',
                'tanggal_selesai_sewa' => '2025-05-13',
                'durasi_hari' => 3,
                'total_harga' => $lightingKit->harga_per_hari * 3,
                'status' => 'Dibatalkan',
                'bukti_transfer_path' => null,
            ]);

            // Riwayat untuk Riwayat Admin (PageController::riwayatAdmin)
            Penyewaan::create([
                'user_id' => $budiSantoso->id,
                'produk_id' => $canon60D->id,
                'tanggal_mulai_sewa' => '2025-05-25',
                'tanggal_selesai_sewa' => '2025-05-26',
                'durasi_hari' => 1,
                'total_harga' => $canon60D->harga_per_hari * 1,
                'status' => 'Selesai',
                'bukti_transfer_path' => null,
            ]);

            Penyewaan::create([
                'user_id' => $felixEdna->id,
                'produk_id' => $lensa50mm->id,
                'tanggal_mulai_sewa' => '2025-05-30',
                'tanggal_selesai_sewa' => '2025-06-01',
                'durasi_hari' => 2,
                'total_harga' => $lensa50mm->harga_per_hari * 2,
                'status' => 'Diproses',
                'bukti_transfer_path' => 'bukti_transfer/contoh_bukti_transfer.jpg', // Contoh path bukti transfer
            ]);
        } else {
            $this->command->info('Tidak dapat menemukan user atau produk untuk seeder penyewaan. Pastikan UserSeeder dan ProdukSeeder sudah dijalankan.');
        }
    }
}
