<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
            ],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'no_hp' => [
                'required',
                'string',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:10',
                'max:15'
            ],
            'alamat' => ['required', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
            'nama_lengkap.required' => 'Nama lengkap harus diisi.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp.regex' => 'Format nomor HP tidak valid.',
            'no_hp.min' => 'Nomor HP minimal 10 digit.',
            'no_hp.max' => 'Nomor HP maksimal 15 digit.',
            'alamat.required' => 'Alamat harus diisi.'
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
            'nama_lengkap' => 'Nama Lengkap',
            'no_hp' => 'Nomor HP',
            'alamat' => 'Alamat'
        ];
    }
}
