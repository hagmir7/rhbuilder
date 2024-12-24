<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = ['logo', 'name', 'descripiton'];


    public function workPosts()
    {
        return $this->hasMany(CompanyWorkPost::class);
    }

    public function resumes()
    {
        return $this->hasManyThrough(Resume::class, WorkPost::class);
    }


    public function shortages()
    {
        return $this->hasManyThrough(Shortage::class, WorkPost::class);
    }
}
