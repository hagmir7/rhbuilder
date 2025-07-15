<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = ['code', 'name', 'description', 'departement_id'];


    public function departement(){
        return $this->belongsTo(Departement::class);
    }


    public function criteria(){
        return $this->belongsToMany(Criteria::class, 'template_criteria');
    }
}
