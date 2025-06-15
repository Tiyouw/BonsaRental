<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_produk' => 'required|exists:produks,id_produk',
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_booking',
            'jumlah' => 'required|integer|min:1',
            'bukti_pembayaran' => 'required|image|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'id_produk.required' => 'Produk harus dipilih.',
            'id_produk.exists' => 'Produk tidak valid.',
            'tanggal_booking.required' => 'Tanggal booking harus diisi.',
            'tanggal_booking.date' => 'Format tanggal booking tidak valid.',
            'tanggal_booking.after_or_equal' => 'Tanggal booking tidak boleh kurang dari hari ini.',
            'tanggal_kembali.required' => 'Tanggal kembali harus diisi.',
            'tanggal_kembali.date' => 'Format tanggal kembali tidak valid.',
            'tanggal_kembali.after' => 'Tanggal kembali harus setelah tanggal booking.',
            'jumlah.required' => 'Jumlah unit harus diisi.',
            'jumlah.integer' => 'Jumlah unit harus berupa angka.',
            'jumlah.min' => 'Jumlah unit minimal 1.',
            'bukti_pembayaran.required' => 'Bukti pembayaran harus diupload.',
            'bukti_pembayaran.image' => 'File harus berupa gambar.',
            'bukti_pembayaran.max' => 'Ukuran file maksimal 2MB.'
        ];
    }
}
