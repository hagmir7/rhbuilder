<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillType extends Model
{
    protected $filable = ['name', 'description'];

    public function skills(){
        return $this->belongsToMany(Skill::class);
    }
}
