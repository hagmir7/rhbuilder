<?php

namespace App\Enums;


enum ResumeGender: int
{


    case FEMALE = 1;
    case MALE = 2;


    public function getLabel()
    {
        return match ($this) {
            self::FEMALE => "Femelle",
            self::MALE => "Mâle",
        };
    }


    public static function toArray()
    {
        return [
            1 => "Femelle",
            2 => "Mâle",
        ];
    }
}
