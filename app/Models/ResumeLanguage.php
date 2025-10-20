<?php

namespace App\Models;

use App\Enums\LanguageLevelEnum;
use Illuminate\Database\Eloquent\Model;

class ResumeLanguage extends Model
{
    protected $fillable = ['resume_id', 'language_id', 'level'];


    protected $casts = [
        'level' => LanguageLevelEnum::class
    ];


    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
    

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
