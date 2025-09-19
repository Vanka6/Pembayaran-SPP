<?php

namespace App\Http\Requests;

use App\Enums\UserGender;
use App\Enums\GraduationStatus;
use App\Enums\StudentGuardianRelationType; // kalau enum hubungan wali sudah ada
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // ======================= A. Informasi Siswa =======================
            'student_email'     => 'required|email|unique:users,email',
            'student_password'  => 'required|min:6',
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

            // ======================= B. Informasi Wali Siswa =======================
            'student_guardian_email'    => 'required|email|unique:users,email',
            'student_guardian_password' => 'required|min:6',
            'guardian_fullname'         => 'required|string|max:100',
            'guardian_phone'            => 'required|string|max:15',
            'relation_type'             => ['required', Rule::in(array_column(StudentGuardianRelationType::cases(), 'value'))],
            'guardian_address'          => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            // siswa
            'student_email.required'    => 'Email Siswa wajib diisi.',
            'student_email.email'       => 'Email Siswa harus berupa alamat email yang valid.',
            'student_email.unique'      => 'Email Siswa sudah terdaftar.',
            'student_password.required' => 'Password Siswa wajib diisi.',
            'student_password.min'      => 'Password Siswa minimal :min karakter.',
            'nis.required'              => 'Nomor Induk Siswa wajib diisi.',
            'nis.max'                   => 'Nomor Induk Siswa maksimal :max karakter.',
            'fullname.required'         => 'Nama Lengkap wajib diisi.',
            'fullname.max'              => 'Nama Lengkap maksimal :max karakter.',
            'date_of_birth.required'    => 'Tanggal Lahir wajib diisi.',
            'date_of_birth.date'        => 'Tanggal Lahir harus berupa tanggal yang valid.',
            'date_of_birth.before'      => 'Tanggal Lahir harus sebelum hari ini.',
            'gender.required'           => 'Jenis Kelamin wajib dipilih.',
            'gender.in'                 => 'Jenis Kelamin tidak valid.',
            'address.max'               => 'Alamat maksimal :max karakter.',
            'phone_number.required'     => 'Nomor Handphone wajib diisi.',
            'phone_number.max'          => 'Nomor Handphone maksimal :max karakter.',
            'mother_name.required'      => 'Nama Ibu Kandung wajib diisi.',
            'mother_name.max'           => 'Nama Ibu Kandung maksimal :max karakter.',
            'graduation_status.in'      => 'Status Kelulusan tidak valid.',
            'departement.required'      => 'Jurusan wajib dipilih.',
            'departement.exists'        => 'Jurusan tidak ditemukan.',
            'classroom.required'        => 'Kelas wajib dipilih.',
            'classroom.exists'          => 'Kelas tidak ditemukan.',

            // wali
            'student_guardian_email.required'    => 'Email Wali wajib diisi.',
            'student_guardian_email.email'       => 'Email Wali harus berupa alamat email yang valid.',
            'student_guardian_email.unique'      => 'Email Wali sudah terdaftar.',
            'student_guardian_password.required' => 'Password Wali wajib diisi.',
            'student_guardian_password.min'      => 'Password Wali minimal :min karakter.',
            'guardian_fullname.required'         => 'Nama Wali wajib diisi.',
            'guardian_fullname.max'              => 'Nama Wali maksimal :max karakter.',
            'guardian_phone.required'            => 'Nomor Handphone Wali wajib diisi.',
            'guardian_phone.max'                 => 'Nomor Handphone Wali maksimal :max karakter.',
            'relation_type.required'             => 'Hubungan Wali wajib dipilih.',
            'relation_type.in'                   => 'Hubungan Wali tidak valid.',
            'guardian_address.max'               => 'Alamat Wali maksimal :max karakter.',
        ];
    }

    public function attributes(): array
    {
        return [
            // siswa
            'student_email'     => 'Email Siswa',
            'student_password'  => 'Password Siswa',
            'nis'               => 'Nomor Induk Siswa',
            'fullname'          => 'Nama Lengkap',
            'date_of_birth'     => 'Tanggal Lahir',
            'gender'            => 'Jenis Kelamin',
            'address'           => 'Alamat',
            'phone_number'      => 'Nomor Handphone',
            'mother_name'       => 'Nama Ibu Kandung',
            'graduation_status' => 'Status Kelulusan',
            'departement'       => 'Jurusan',
            'classroom'         => 'Kelas',

            // wali
            'student_guardian_email'    => 'Email Wali',
            'student_guardian_password' => 'Password Wali',
            'guardian_fullname'         => 'Nama Wali',
            'guardian_phone'            => 'Nomor Handphone Wali',
            'relation_type'             => 'Hubungan Wali',
            'guardian_address'          => 'Alamat Wali',
        ];
    }
}
