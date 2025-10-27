<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    protected $fillable = ['code', 'resume_id', 'post_id', 'evaluation_date', 'hire_date', 'responsible_id', 'period'];


    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function responsible()
    {
        return $this->belongsTo(User::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'integration_activity')->withPivot(['date']);
    }
}
