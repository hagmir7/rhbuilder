<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shortage extends Model
{

    protected $fillable = ['work_post_id', 'number', 'status', 'descripiton', 'min_experience', 'level_id', 'end_date'];


    public function workPost(){
        return $this->belongsTo(WorkPost::class);
    }


    public function level(){
        return $this->belongsTo(Level::class);
    }

}
