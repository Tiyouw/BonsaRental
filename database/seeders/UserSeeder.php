<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'nama_lengkap' => 'Administrator',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Admin No. 1'
        ]);

        // Create sample customers
        $customers = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'nama_lengkap' => 'John Doe',
                'no_hp' => '081234567891',
                'alamat' => 'Jl. Sudirman No. 123, Jakarta'
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'nama_lengkap' => 'Jane Smith',
                'no_hp' => '081234567892',
                'alamat' => 'Jl. Thamrin No. 456, Jakarta'
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'nama_lengkap' => 'Alice Johnson',
                'no_hp' => '081234567893',
                'alamat' => 'Jl. Gatot Subroto No. 789, Jakarta'
            ],
            [
                'name' => 'Bob Wilson',
                'email' => 'bob@example.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'nama_lengkap' => 'Bob Wilson',
                'no_hp' => '081234567894',
                'alamat' => 'Jl. Asia Afrika No. 321, Bandung'
            ]
        ];

        foreach ($customers as $customer) {
            User::create($customer);
        }
    }
}
