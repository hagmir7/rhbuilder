<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
    protected $fillable = ['code', 'name', 'need_id', 'description'];


    public function need(){
        return $this->belongsTo(Need::class);
    }

    public function resumes(){
        return $this->belongsToMany(Resume::class, 'resume_selection');
    }
}
