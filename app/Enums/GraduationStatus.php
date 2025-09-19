<?php

namespace App\Enums;

enum GraduationStatus: string
{
    case Passed = 'lulus';
    case NotPassed = 'tidak lulus';
    case NotYetGraduated = 'belum lulus';

    public static function options(): array
    {
        return array_column(self::cases(), 'value', 'name');
    }

    public function label(): string
    {
        return match ($this) {
            self::Passed => 'Lulus',
            self::NotPassed => 'Tidak Lulus',
            self::NotYetGraduated => 'Belum Lulus',
        };
    }
}
