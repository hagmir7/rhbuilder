<?php

namespace App\Enums;



enum ResumeMaritalStatusEnum : int {


    case SINGLE = 1;
    case MARRIED = 2;
    case WINDOWED = 3;


    public function getLabel(){
        return match($this){
            1 => "Célibataire",
            2 => "Marié(e)",
            3 => "Veuf/Veuve"
        };
    }
}