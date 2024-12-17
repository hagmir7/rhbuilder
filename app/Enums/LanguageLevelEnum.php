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


    public function getLable(): string
    {
        return match ($this) {
            1 => "A1",
            2 => "A2",
            3 => "B1",
            4 => "B2",
            5 => "C1",
            6 => "C2"
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
