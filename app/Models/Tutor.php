<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tutor extends Pivot
{
    use HasFactory;

    protected $table = 'tutors';

    protected $fillable = [
        'user_id',
        'course_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
