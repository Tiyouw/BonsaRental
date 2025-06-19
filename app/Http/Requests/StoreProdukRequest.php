<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Ubah menjadi true agar request diizinkan
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_per_hari' => 'required|numeric|min:0', // UBAH dari harga_sewa
            'stock' => 'required|integer|min:0',         // UBAH dari stok
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_kategori' => 'required|exists:kategoris,id', // UBAH dari kategori_id, pastikan tabel 'kategoris'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'id_kategori.required' => 'Kategori produk wajib dipilih.',
            'id_kategori.exists' => 'Kategori yang dipilih tidak valid.',
            'deskripsi.required' => 'Deskripsi produk wajib diisi.',
            'harga_per_hari.required' => 'Harga sewa wajib diisi.', // UBAH
            'harga_per_hari.numeric' => 'Harga sewa harus berupa angka.', // UBAH
            'harga_per_hari.min' => 'Harga sewa tidak boleh negatif.', // UBAH
            'stock.required' => 'Stok wajib diisi.', // UBAH
            'stock.integer' => 'Stok harus berupa bilangan bulat.', // UBAH
            'stock.min' => 'Stok tidak boleh negatif.', // UBAH
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, PNG, JPEG, GIF, atau SVG.',
            'gambar.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ];
    }
}
