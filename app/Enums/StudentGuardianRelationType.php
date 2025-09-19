<?php

namespace App\Enums;

enum StudentGuardianRelationType: string
{
    case Father = 'father';
    case Mother = 'mother';
    case StudentGuardian = 'guardian';

    public static function options(): array
    {
        return array_column(self::cases(), 'value', 'name');
    }

    public function label(): string
    {
        return match ($this) {
            self::Father => 'Ayah',
            self::Mother => 'Ibu',
            self::StudentGuardian => 'Wali Siswa',
        };
    }
}
