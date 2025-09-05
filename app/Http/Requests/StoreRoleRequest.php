<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var \Illuminate\Http\Request $this */
        return $this->user()->can('create', Role::class);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:roles,name',
            'description' => 'nullable|string|max:255',

            // Add this for permission validation
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama role wajib diisi.',
            'name.unique' => 'Nama role sudah digunakan.',
            'description.max' => 'Deskripsi tidak boleh lebih dari 255 karakter.',

            // Add custom messages for permissions
            'permissions.array' => 'Format permission tidak valid.',
            'permissions.*.exists' => 'Permission yang dipilih tidak valid.',
        ];
    }
}
