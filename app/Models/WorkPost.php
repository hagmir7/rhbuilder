<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkPost extends Model
{
    protected $fillable = ['company', 'resume_id', 'work_post', 'start_date', 'end_date'];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

    public function workPost()
    {
        return $this->belongsTo(WorkPost::class);
    }
}
