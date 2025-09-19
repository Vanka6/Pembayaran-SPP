<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\StudentGuardianRelationType;

class StoreStudentGuardianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Izinkan pengguna mengakses request ini
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'], // wajib saat store
            'fullname' => ['required', 'string', 'max:100'],
            'phone_number' => ['required', 'string', 'max:15'],
            'relation_type' => ['required', new Enum(StudentGuardianRelationType::class)],
            'address' => ['required', 'string'],
        ];
    }
}
