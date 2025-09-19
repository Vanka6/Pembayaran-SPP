<?php

namespace App\Http\Requests;

use App\Enums\UserStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var \Illuminate\Http\Request $this */
        return $this->user()->can('update', auth()->user());
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
            'status' => ['required', new Enum(UserStatus::class)],
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
