<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyWorkPost extends Model
{
    protected $fillable = ['name', 'company_id', 'description'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
