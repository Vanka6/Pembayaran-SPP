<?php

namespace App\Http\Requests;

use App\Models\Student;
use App\Enums\UserGender;
use App\Enums\GraduationStatus;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var \Illuminate\Http\Request $this */
        $student = $this->route('student'); // pastikan route pakai {student}
        $userId = $student?->user?->id;
        return [
            // ======================= A. Informasi Siswa =======================
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password'          => 'nullable|min:6',
            'nis'               => 'required|string|max:30',
            'fullname'          => 'required|string|max:100',
            'date_of_birth'     => 'required|date|before:today',
            'gender'            => ['required', Rule::in(array_column(UserGender::cases(), 'value'))],
            'address'           => 'nullable|string|max:255',
            'phone_number'      => 'required|string|max:15',
            'mother_name'       => 'required|string|max:100',
            'graduation_status' => ['nullable', Rule::in(array_column(GraduationStatus::cases(), 'value'))],
            'departement'       => 'required|exists:departements,id',
            'classroom'         => 'required|exists:classrooms,id',

        ];
    }

    public function messages(): array
    {
        return [
            'nis.required'              => 'Nomor Induk Siswa wajib diisi.',
            'nis.max'                   => 'Nomor Induk Siswa maksimal :max karakter.',
            'nis.unique'                => 'Nomor Induk Siswa sudah digunakan.',
            'fullname.required'         => 'Nama Lengkap wajib diisi.',
            'fullname.max'              => 'Nama Lengkap maksimal :max karakter.',
            'date_of_birth.required'    => 'Tanggal Lahir wajib diisi.',
            'date_of_birth.date'        => 'Tanggal Lahir harus berupa tanggal yang valid.',
            'date_of_birth.before'      => 'Tanggal Lahir harus sebelum hari ini.',
            'gender.required'           => 'Jenis Kelamin wajib dipilih.',
            'gender.in'                 => 'Jenis Kelamin tidak valid.',
            'departement.required'      => 'Jurusan wajib dipilih.',
            'departement.exists'        => 'Jurusan tidak ditemukan.',
            'classroom.required'        => 'Kelas wajib dipilih.',
            'classroom.exists'          => 'Kelas tidak ditemukan.',
            'phone_number.required'     => 'Nomor Handphone wajib diisi.',
            'phone_number.max'          => 'Nomor Handphone maksimal :max karakter.',
            'mother_name.required'      => 'Nama Ibu Kandung wajib diisi.',
            'mother_name.max'           => 'Nama Ibu Kandung maksimal :max karakter.',
            'graduation_status.in'      => 'Status Kelulusan tidak valid.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nis'               => 'Nomor Induk Siswa',
            'fullname'          => 'Nama Lengkap',
            'date_of_birth'     => 'Tanggal Lahir',
            'gender'            => 'Jenis Kelamin',
            'departement'       => 'Jurusan',
            'classroom'         => 'Kelas',
            'address'           => 'Alamat',
            'phone_number'      => 'Nomor Handphone',
            'mother_name'       => 'Nama Ibu Kandung',
            'graduation_status' => 'Status Kelulusan',
        ];
    }
}
