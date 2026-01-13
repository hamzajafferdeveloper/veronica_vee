<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'phone',
        'dob',
        'gender',
        'resume',
        'cover_letter',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assets()
    {
        return $this->hasMany(ApplicationAsset::class);
    }
}
