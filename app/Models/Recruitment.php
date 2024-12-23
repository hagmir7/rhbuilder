<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    
    protected $fillable = [
        'name',
        'company_work_post_id',
        'description',
    ];


    public function companyWorkPost()
    {
        return $this->belongsTo(CompanyWorkPost::class);
    }

    public function resumeRecruitmen()
    {
        return $this->hasMany(ResumeRectruitment::class);
    }

    public function resumes()
    {
        return $this->belongsToMany(Resume::class, 'resume_rectruitments');
    }
}
