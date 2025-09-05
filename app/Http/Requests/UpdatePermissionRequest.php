<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var \Illuminate\Http\Request $this */
        return $this->user()->can('update', $this->route('permission'));
    }

    public function rules(): array
    {
        /** @var \Illuminate\Http\Request $this */
        $permissionId = $this->route('permission')->id;

        return [
            'name' => 'required|unique:permissions,name,' . $permissionId,
            'description' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama permission wajib diisi.',
            'name.unique' => 'Nama permission sudah digunakan.',
            'description.max' => 'Deskripsi tidak boleh lebih dari 255 karakter.',
        ];
    }
}
