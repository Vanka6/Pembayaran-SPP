<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Ubah ke true agar bisa dipakai
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'departement_name' => 'required|string|max:30|unique:departements,departement_name',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'departement_name.required' => 'Nama jurusan wajib diisi.',
            'departement_name.string' => 'Nama jurusan harus berupa teks.',
            'departement_name.max' => 'Nama jurusan maksimal :max karakter.',
            'departement_name.unique' => 'Nama jurusan sudah digunakan.',
        ];
    }

    /**
     * Custom attribute names.
     */
    public function attributes(): array
    {
        return [
            'departement_name' => 'nama jurusan',
        ];
    }
}
