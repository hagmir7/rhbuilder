<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $fillable = ['code', 'description', 'criteria_type_id'];

    public function criteriaType(){
        return $this->belongsTo(CriteriaType::class, 'criteria_type_id', 'id');
    }
}
