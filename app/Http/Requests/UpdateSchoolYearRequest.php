<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchoolYearRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var \Illuminate\Http\Request $this */
        return $this->user()->can('update', auth()->user());
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        /** @var \Illuminate\Http\Request $this */
        $schoolYearId = $this->route('school_year')->id;

        return [
            'year_label'   => 'required|string|max:20|unique:school_years,year_label,' . $schoolYearId,
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'description'  => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'year_label.required'  => 'Label tahun ajaran wajib diisi.',
            'year_label.string'    => 'Label tahun ajaran harus berupa teks.',
            'year_label.max'       => 'Label tahun ajaran maksimal :max karakter.',
            'year_label.unique'    => 'Label tahun ajaran sudah digunakan.',
            'start_date.required'  => 'Tanggal mulai wajib diisi.',
            'start_date.date'      => 'Tanggal mulai harus berupa tanggal yang valid.',
            'end_date.required'    => 'Tanggal selesai wajib diisi.',
            'end_date.date'        => 'Tanggal selesai harus berupa tanggal yang valid.',
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',
            'description.string'   => 'Deskripsi harus berupa teks.',
        ];
    }

    public function attributes(): array
    {
        return [
            'year_label'  => 'label tahun ajaran',
            'start_date'  => 'tanggal mulai',
            'end_date'    => 'tanggal selesai',
            'description' => 'deskripsi',
        ];
    }
}
