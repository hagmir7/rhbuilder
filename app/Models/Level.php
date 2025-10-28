<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['name', 'years', 'coefficient', 'description'];

    public function resumes()
    {
        return $this->belongsToMany(Resume::class, 'diplomas')
            ->withPivot(['name', 'end_date', 'institution', 'private']);
    }
}
