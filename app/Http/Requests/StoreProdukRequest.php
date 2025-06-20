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
        return true;
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
            'harga_per_hari' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // UBAH: Menggunakan nama tabel dan primary key yang benar
            'id_kategori' => 'required|exists:kategori_produk,id_kategori',
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
            'harga_per_hari.required' => 'Harga sewa wajib diisi.',
            'harga_per_hari.numeric' => 'Harga sewa harus berupa angka.',
            'harga_per_hari.min' => 'Harga sewa tidak boleh negatif.',
            'stock.required' => 'Stok wajib diisi.',
            'stock.integer' => 'Stok harus berupa bilangan bulat.',
            'stock.min' => 'Stok tidak boleh negatif.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, PNG, JPEG, GIF, atau SVG.',
            'gambar.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ];
    }
}
