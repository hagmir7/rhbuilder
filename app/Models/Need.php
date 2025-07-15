<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    protected $fillable = [
        'service_id',
        'responsable_id',
        'diplome_id',
        'experience_min',
        'gender',
        'min_age',
        'max_age',
        'status',
        'description'
    ];
}
