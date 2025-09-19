<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Enums\UserStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var \Illuminate\Http\Request $this */
        return $this->user()->can('create', User::class);
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|string|exists:roles,name',
            'status' => ['required', new Enum(UserStatus::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal :min karakter.',

            'role.required' => 'Role wajib dipilih.',
            'role.exists' => 'Role yang dipilih tidak valid.',

            'status.required' => 'Status wajib dipilih.',
            'status.enum' => 'Status yang dipilih tidak valid.',
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'alamat email',
            'password' => 'kata sandi',
            'role' => 'peran pengguna',
            'status' => 'status pengguna',
        ];
    }
}
