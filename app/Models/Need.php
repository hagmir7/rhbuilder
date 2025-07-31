<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    protected $fillable = [
        'service_id',
        'responsable_id',
        'level_id',
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
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function level(){
        return $this->belongsTo(Level::class);
    }


    public function skills(){
        return $this->belongsToMany(Skill::class, 'need_skill');
    }


}
