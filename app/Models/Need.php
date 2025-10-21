<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    protected $fillable = [
        'service_id',
        'responsible_id',
        'experience_min',
        'gender',
        'min_age',
        'max_age',
        'status',
        'description'
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function responsible(){
        return $this->belongsTo(User::class, 'responsible_id');
    }

    public function levels(){
        return $this->belongsToMany(Level::class, 'need_level');
    }


    public function skills(){
        return $this->belongsToMany(Skill::class, 'need_skill');
    }

    public function resumes(){
        return $this->belongsToMany(Resume::class, 'need_resume')->withPivot('resume_id', 'need_id', 'invitation_id');
    }

}
