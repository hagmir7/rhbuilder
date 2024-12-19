<?php

namespace APP\Enums;


enum LanguageLevelEnum: int
{


    case A1 = 1;
    case A2 = 2;
    case B1 = 3;
    case B2 = 4;
    case C1 = 5;
    case C2 = 6;


    public function getLabel(): string
    {
        return match ($this) {
            self::A1 => "A1",
            self::A2 => "A2",
            self::B1 => "B1",
            self::B2 => "B2",
            self::C1 => "C1",
            self::C2 => "C2"
        };
    }


    public static function toArray(): array
    {
        return [
            1 => "A1",
            2 => "A2",
            3 => "B1",
            4 => "B2",
            5 => "C1",
            6 => "C2"
        ];
    }
}
