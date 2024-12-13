<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name'];

    public function resumeSkills()
    {
        return $this->hasMany(ResumeSkill::class);
    }
}