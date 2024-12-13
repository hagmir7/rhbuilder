<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeLanguage extends Model
{
    protected $fillable = ['resume_id', 'language_id', 'level'];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
