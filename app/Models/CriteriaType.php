<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CriteriaType extends Model
{
    protected $fillable = ['name', 'description'];

    public function criteria(){
        return $this->hasMany(Criteria::class, 'criteria_type_id');
    }
}
