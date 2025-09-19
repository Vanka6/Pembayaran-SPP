<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Ubah ke true agar request bisa digunakan
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        /** @var \Illuminate\Http\Request $this */
        return [
            'departement_name' => [
                'required',
                'string',
                'max:30',
                Rule::unique('departements', 'departement_name')->ignore($this->route('departement')),
            ],
            'classrooms' => 'required|array',
            'classrooms.*' => 'exists:classrooms,id',
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
            'classrooms.required' => 'Kelas harus dipilih.',
            'classrooms.array' => 'Format kelas tidak valid.',
            'classrooms.*.exists' => 'Kelas yang dipilih tidak valid.',
        ];
    }

    /**
     * Custom attribute names.
     */
    public function attributes(): array
    {
        return [
            'departement_name' => 'nama jurusan',
            'classrooms' => 'nama kelas'
        ];
    }
}
