<?php

namespace App\Enums;

enum InvitationStatus: int
{
    case PENDING = 1;
    case PLANNED = 2;
    case MISSED_CALL = 3;
    case ARCHIVED = 4;
    case EXPIRED = 5;
    case CANCELD = 6;

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => "En attente",
            self::PLANNED => "Planifié",
            self::MISSED_CALL => "Appel manqué",
            self::ARCHIVED => "Archivé",
            self::EXPIRED => "Expiré",
            self::CANCELD => "Annulé",
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
