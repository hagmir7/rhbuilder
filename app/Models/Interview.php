<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $fillable = [
        'responsible_id',
        'user_id',
        'resume_id',
        'post_id',
        'template_id',
        'date',
        'type',
        'company_id',
        'decision',
        'invitation_id'
    ];

    protected static function booted()
    {
        static::creating(function ($template) {
            $nextId = (self::max('id') ?? 0) + 1;
            $template->code = 'INTV' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
        });
    }

     public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function criteria(){
        return $this->belongsToMany(Criteria::class, 'interview_criteria')->withPivot('note');
    }

   
}
