<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var \Illuminate\Http\Request $this */
        return $this->user()->can('update', $this->route('user')) || $this->user()->hasRole('admin');
    }

    public function rules(): array
    {
        /** @var \Illuminate\Http\Request $this */
        $userId = $this->route('user') instanceof \App\Models\User
            ? $this->route('user')->id
            : $this->route('user');

        return [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password' => 'nullable|min:6',
            'role' => 'required|string|exists:roles,name',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.min' => 'Password minimal :min karakter jika diubah.',
            'role.required' => 'Role wajib dipilih.',
            'role.exists' => 'Role yang dipilih tidak valid.',
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'alamat email',
            'password' => 'kata sandi',
            'role' => 'peran pengguna',
        ];
    }
}
