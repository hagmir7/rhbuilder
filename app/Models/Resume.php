<?php

namespace App\Models;

use App\Enums\ResumeMaritalStatusEnum;
use App\Enums\ResumeStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Resume extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city_id',
        'level',
        'status',
        'user_id',
        'cv_file',
        'cover_letter_file',
        'company_work_post_id',
        'marital_status',
        'experience_monthe',
        'birth_date',
        'gender',
        'cin',
        'nationality'
    ];


    protected $casts = [
        'marital_status' => ResumeMaritalStatusEnum::class,
        'status' => ResumeStatusEnum::class
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function levels()
    {
        return $this->belongsToMany(Level::class, 'diplomas')->withPivot(['name', 'end_date', 'institution', 'private']);
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


    public function workPost()
    {
        return $this->belongsTo(CompanyWorkPost::class);
    }


    public function recruitments()
    {
        return $this->belongsToMany(Recruitment::class, 'resume_rectruitments');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }


    function daysToMonths($days) {
        $daysPerMonth = 30.44;
        return $days / $daysPerMonth;
    }

    public function getExperience() :int
    {
        $totalDays = 0;

        foreach ($this->experiences as $experience) {
            $startDate = Carbon::parse($experience->start_date);
            if($experience->end_date == null){
                $endDate = Carbon::now();
            }else{
                $endDate = Carbon::parse($experience->end_date);
            }
            $daysDifference = $startDate->diffInDays($endDate);
            $totalDays += $daysDifference;
        }
        return round($this->daysToMonths($totalDays), 0);
    }

}
