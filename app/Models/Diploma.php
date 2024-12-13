<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diploma extends Model
{
    protected $fillable = [
        'user_id', 'name', 'start_date', 'end_date', 
        'type', 'institution', 'private'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function level(){
        return $this->belongsTo(Level::class);
    }
}
