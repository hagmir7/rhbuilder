<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class NeedResume extends Pivot
{

    protected $fillable = [
        'resume_id',
        'need_id',
        'invitation_id',
    ];
}
