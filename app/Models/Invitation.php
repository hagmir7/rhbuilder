<?php

namespace App\Models;

use App\Enums\InvitationTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'date',
        'resume_id',
        'interview_date',
        'accepted',
        'type',
        'status'
    ];


    protected $casts = [
        'type' =>  InvitationTypeEnum::class,
         'interview_date' => 'datetime',
         'date' => 'datetime',
    ];



    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
