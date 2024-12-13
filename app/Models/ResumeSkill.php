<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeSkill extends Model
{
    protected $fillable = ['skill_id', 'resume_id'];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
