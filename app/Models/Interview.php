<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $fillable = [
        'code',
        'responsible_id',
        'user_id',
        'resume_id',
        'post_id',
        'template_id',
        'date',
        'type',
        'company_id',
        'decision'
    ];
}
