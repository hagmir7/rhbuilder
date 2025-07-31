<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $fillable = ['name', 'logo', 'description'];

    public function services(){
        return $this->hasMany(Service::class);
    }
}
