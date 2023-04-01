<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutor_id',
        'date',
        'start_time',
        'end_time',
    ];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class)->using(Attendee::class);
    }
}
