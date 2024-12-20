<?php

namespace App\Enums;


enum InvitationTypeEnum: int
{

    case IN_PERSON = 1;
    case REMOTELY = 2;


    public function getLabel(): string
    {
        return match ($this) {
            self::IN_PERSON => "En présentiel",
            self::REMOTELY => "À distance"
        };
    }


    public static function toArray(): array
    {
        return [
            1 => "En présentiel",
            2 => "À distance"
        ];
    }
}
