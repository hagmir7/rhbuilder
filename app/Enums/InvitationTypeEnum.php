<?php

namespace App\Enums;


enum InvitationTypeEnum : int
{

    case IN_PERSON = 1;
    case REMOTELY = 2;


    public function getLabel(): string
    {
        return match($this){
            1 => "En présentiel",
            2 => "À distance"
        };
    }
}