<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Run all seeders in correct order
        $this->call([
            UserSeeder::class,        // Create admin and customer users
            KategoriSeeder::class,    // Create product categories
            ProdukSeeder::class,      // Create sample products
            BookingSeeder::class,     // Create sample bookings
        ]);
    }
}
