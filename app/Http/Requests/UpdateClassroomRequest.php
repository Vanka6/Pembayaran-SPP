<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassroomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Sesuaikan dengan kebutuhan auth Anda
        /** @var \Illuminate\Http\Request $this */
        return $this->user()->can('update', auth()->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        /** @var \Illuminate\Http\Request $this */
        $classroomId = $this->route('classroom')->id; // pastikan route model binding digunakan

        return [
            'classroom_name' => 'required|string|max:5|unique:classrooms,classroom_name,' . $classroomId,
        ];
    }

    public function messages(): array
    {
        return [
            'classroom_name.required' => 'Nama kelas wajib diisi.',
            'classroom_name.string'   => 'Nama kelas harus berupa teks.',
            'classroom_name.max'      => 'Nama kelas tidak boleh lebih dari :max karakter.',
            'classroom_name.unique'   => 'Nama kelas sudah digunakan.',
        ];
    }

    public function attributes(): array
    {
        return [
            'classroom_name' => 'nama kelas',
        ];
    }
}
