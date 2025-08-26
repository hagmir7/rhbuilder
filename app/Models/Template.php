<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = ['name', 'description', 'departement_id'];


    public function departement(){
        return $this->belongsTo(Departement::class);
    }


    public function criteria(){
        return $this->belongsToMany(Criteria::class, 'template_criteria');
    }


    protected static function booted()
    {
        static::creating(function ($template) {
            $nextId = (self::max('id') ?? 0) + 1;
            $template->code = 'TM' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
        });
    }

}
