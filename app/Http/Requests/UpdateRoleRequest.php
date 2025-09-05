<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var \Illuminate\Http\Request $this */
        return $this->user()->can('update', $this->route('role'));
    }

    public function rules(): array
    {
        /** @var \Illuminate\Http\Request $this */
        $roleId = $this->route('role')->id;

        return [
            'name' => 'required|unique:roles,name,' . $roleId,
            'description' => 'nullable|string|max:255',

            // Permissions input
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

            'permissions.array' => 'Format permission tidak valid.',
            'permissions.*.exists' => 'Permission yang dipilih tidak valid.',
        ];
    }
}
