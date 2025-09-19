<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;
use App\Enums\StudentGuardianRelationType;

class UpdateStudentGuardianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var \Illuminate\Http\Request $this */
        return [
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user_id ?? $this->student_guardian?->user_id)
            ],
            'password' => ['nullable', 'string', 'min:8'], // boleh kosong saat update
            'fullname' => ['required', 'string', 'max:100'],
            'phone_number' => ['required', 'string', 'max:15'],
            'relation_type' => ['required', new Enum(StudentGuardianRelationType::class)],
            'address' => ['required', 'string'],
        ];
    }
}
