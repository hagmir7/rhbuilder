<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'departement_id', 'responsible_id', 'description'];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function responsible(){
        return $this->belongsTo(User::class, 'responsible_id');
    }
}
