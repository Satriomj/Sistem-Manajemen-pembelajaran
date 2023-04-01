<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'tutors', 'course_id', 'user_id', 'id', 'id')->withPivot(
            [
                'id',
                'user_id',
                'course_id',
            ],
        )->using(Tutor::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
