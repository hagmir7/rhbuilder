<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillType extends Model
{
    protected $fillable = ['name', 'description'];

    public function skills(){
        return $this->hasMany(Skill::class, 'skill_type_id');
    }
}
