<?php

namespace App\Enums;

enum InvitationStatus: int
{
    case PENDING = 1;
    case INTERVIEW_SCHEDULED = 2;
    case MISSED_CALL = 3;
    case DECLINED = 4;

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => "En attente",
            self::INTERVIEW_SCHEDULED => "Entretien planifié",
            self::MISSED_CALL => "Appel manqué",
            self::DECLINED => "Refusé",
        };
    }

    public static function toArray(): array
    {
        return array_combine(
            array_map(fn($case) => $case->value, self::cases()),
            array_map(fn($case) => $case->getLabel(), self::cases())
        );
    }
}
