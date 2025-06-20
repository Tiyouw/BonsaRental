<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Import model User
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        // Pastikan hanya user yang terautentikasi dan memiliki role 'admin' yang bisa mengakses
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the customers.
     * Includes search, sort, and pagination.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'customer'); // Hanya ambil user dengan role 'customer'

        // Initialize $search variable to an empty string to prevent 'Undefined variable' error
        $search = '';

        // Logika Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search; // Assign search term if present
            $query->where(function($q) use ($search) {
                $q->where('username', 'like', '%' . $search . '%')
                  ->orWhere('nama_lengkap', 'like', '%' . $search . '%')
                  ->orWhere('no_hp', 'like', '%' . $search . '%');
            });
        }

        // Logika Pengurutan
        $sortBy = $request->get('sort_by', 'created_at'); // Default sort by creation date
        $sortOrder = $request->get('sort_order', 'desc'); // Default sort order desc

        // Validasi dan terapkan pengurutan
        if (in_array($sortBy, ['username', 'nama_lengkap', 'no_hp', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            // Fallback jika sortBy tidak valid
            $query->orderBy('created_at', 'desc');
        }

        // Pagination
        $customers = $query->paginate(10); // Menampilkan 10 pelanggan per halaman

        return view('admin.customers.index', compact('customers', 'search', 'sortBy', 'sortOrder'));
    }

    /**
     * Display the specified customer.
     *
     * @param  int  $id The ID of the customer to display.
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Temukan pelanggan berdasarkan ID dan pastikan rolenya adalah 'customer'
        $customer = User::where('id', $id)
                        ->where('role', 'customer')
                        ->firstOrFail();

        return view('admin.customers.show', compact('customer'));
    }
}
