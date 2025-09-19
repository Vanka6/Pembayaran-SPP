<?php

namespace App\Enums;

enum UserGender: string
{
    case Male = 'male';
    case Female = 'female';

    public static function options(): array
    {
        return array_column(self::cases(), 'value', 'name');
    }

    public function label(): string
    {
        return match ($this) {
            self::Male => 'Laki-Laki',
            self::Female => 'Perempuan',
        };
    }
}
