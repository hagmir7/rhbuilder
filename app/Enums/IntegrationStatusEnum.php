<?php

namespace App\Enums;

enum IntegrationStatusEnum: int
{
    case PENDING = 0;
    case IN_PROGRESS = 1;
    case FINISHED = 2;
    case EXPIRED = 3;
    case CANCELD = 4;



    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => "En attente",
            self::IN_PROGRESS => "En cours",
            self::FINISHED => "Terminé",
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
