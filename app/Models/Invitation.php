<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'date', 'interview_date', 'accepted', 'type'
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
