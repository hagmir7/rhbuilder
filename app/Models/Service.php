<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'departement_id', 'description', 'responsible_id'];

    
    public function departement(){
        return $this->belongsTo(Departement::class);
    }


    public function responsible(){
        return $this->belongsTo(User::class, 'responsible_id');
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }


}
