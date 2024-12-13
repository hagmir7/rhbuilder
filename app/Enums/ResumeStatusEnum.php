<?php

namespace App\Enums;


enum ResumeStatusEnum: int
{

    case NEW = 1;
    case INVITATION = 2;
    case EVALUATION = 3;
    case ACCEPTED = 4;
    case ENGAGED = 5;

    public function getLable(): string
    {
        return match ($this) {
            self::NEW => "Nouveau",
            self::INVITATION => "Invitation",
            self::EVALUATION => "Évaluation",
            self::ACCEPTED => "Accepté",
            self::ENGAGED => "Engagé"
        };
    }

    public static function toArray(): array
    {
        return [
            1 => "Nouveau",
            2 => "Invitation",
            3 => "Évaluation",
            4 => "Accepté",
            5 => "Engagé"
        ];
    }
}
