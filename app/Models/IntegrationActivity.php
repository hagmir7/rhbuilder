<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class IntegrationActivity extends Pivot
{
    protected $fillable = ['integration_id', 'activity_id', 'date'];
    
}
