<?php

namespace App\Models;

use App\Enums\ResumeMaritalStatusEnum;
use App\Enums\ResumeStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 
        'address', 'city_id', 'level', 'status', 'user_id',
        'cv_file', 'cover_letter_file', 'company_work_post_id', 'marital_status'
    ];


    protected $casts = [
        'marital_status' => ResumeMaritalStatusEnum::class,
        'status' => ResumeStatusEnum::class
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
        return $this->belongsToMany(Skill::class, 'resume_skills');
    }

    public function languages()
    {
        return $this->hasMany(ResumeLanguage::class);
    }
    

    public function workPost(){
        return $this->belongsTo(CompanyWorkPost::class);
    }
}
