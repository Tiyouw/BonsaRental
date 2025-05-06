<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function landing()
    {
        return view('landing');
    }

    public function login()
    {
        return view('login');
    }

    public function submit(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        return redirect()->route('dashboard', ['username' => $username, 'password' => $password]);
    }

    public function dashboard(Request $request)
    {
        $username = $request->query('username');

        // Array of camera equipment similar to your colleague's bus array
        $cameras = [
            [
                'image' => 'assets/camera1.jpg',
                'name' => 'Canon EOS R5',
                'category' => 'Camera',
                'price' => 'Rp 150.000/hari',
            ],
            [
                'image' => 'assets/lens1.jpg',
                'name' => 'Canon RF 24-70mm f/2.8L',
                'category' => 'Lens',
                'price' => 'Rp 100.000/hari',
            ],
            // Add more camera equipment here
        ];

        return view('dashboard', ['cameras' => $cameras, 'username' => $username]);
    }

    public function profile(Request $request)
    {
        $username = $request->query('username');
        $password = $request->query('password');

        return view('profile', ['username' => $username, 'password' => $password]);
    }

    public function pengelolaan()
    {
        // Array for katalog management similar to your colleague's fleets
        $katalog = [
            [
                'image' => 'assets/camera1.jpg',
                'name' => 'Canon EOS R5',
                'category' => 'Camera',
                'stock' => '5',
                'daily_price' => 'Rp 150.000',
                'weekly_price' => 'Rp 900.000',
                'monthly_price' => 'Rp 3.000.000',
            ],
            // Add more inventory items
        ];

        return view('pengelolaan', ['katalog' => $katalog]);
    }
}
