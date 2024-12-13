<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'name', 'provider', 'start_date', 'end_date'
    ];


    public function resume(){

    }
}
