<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 
        'address', 'city_id', 'level', 'status', 'user_id',
        'cv_file', 'cover_letter_file', 'work_post_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function diplomas()
    {
        return $this->hasMany(Diploma::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function skills()
    {
        return $this->hasMany(ResumeSkill::class);
    }

    public function languages()
    {
        return $this->hasMany(ResumeLanguage::class);
    }
}
