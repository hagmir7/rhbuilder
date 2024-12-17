<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'resume_id', 'company', 'work_post', 
        'start_date', 'end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
