<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $fillable = ['code', 'description', 'criteria_type_id'];

    public function criteriaType()
    {
        return $this->belongsTo(CriteriaType::class, 'criteria_type_id', 'id');
    }

    protected static function booted()
    {
        static::creating(function ($template) {
            $nextId = (self::max('id') ?? 0) + 1;
            $template->code = 'C' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
        });
    }
}
