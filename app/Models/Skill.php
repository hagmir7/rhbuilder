<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name'];

    public function resumes()
    {
        return $this->belongsToMany(Resume::class, 'resume_skills')->withTimestamps();
    }

    public function type(){
        return $this->belongsTo(SkillType::class, 'skill_type_id');
    }
}
