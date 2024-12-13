<?php

namespace App\Models;

use App\Enums\InvitationTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'date', 'interview_date', 'accepted', 'type'
    ];


    protected $casts = [
        'type' =>  InvitationTypeEnum::class,
    ];


    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
