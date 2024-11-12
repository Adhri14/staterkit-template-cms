<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name'            => 'required|max:100',
            'last_name'             => 'required|max:100',
            'dob'                   => 'required|date',
            'phone'                 => 'required|max:100',
            'address'               => 'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'            => 'Nama depan wajib diisi.',
            'last_name.required'             => 'Nama belakang wajib diisi.',
            'email.required'                 => 'Email wajib diisi.',
            'email.email'                    => 'Email tidak valid.',
            'email.unique'                   => 'Email ini sudah terdaftar.',
            'dob.required'                   => 'Tanggal lahir wajib diisi.',
            // 'id_card'                        => 'Wajib upload KTP.',
            // 'agree_ktp'                      => 'Persetujuan ini diperlukan.',
            // 'agree'                          => 'Persetujuan syarat dan ketentuan diperlukan.',
            'security_question'              => 'Pertanyaan keamanan wajib diisi.',
            'password.required'              => 'Password wajib diisi.',
            'password.confirmed'             => 'Password konfirmasi tidak cocok.',
            'password_confirmation.required' => 'Password konfirmasi wajib diisi.'
        ];
    }
}
