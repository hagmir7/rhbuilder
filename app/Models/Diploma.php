<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diploma extends Model
{
    protected $fillable = [
        'resume_id',
        'name',
        'end_date',
        'institution',
        'private',
        'level_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
