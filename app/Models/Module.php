<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tutor_id',
    ];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function attachments()
    {
        return $this->hasMany(ModuleAttachment::class);
    }
}
