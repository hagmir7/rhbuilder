<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class InterviewCriteria extends Pivot
{
    protected $fillable = ['criteria_id', 'interview_id', 'note'];

}
