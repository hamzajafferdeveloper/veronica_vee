<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelProfiles extends Model
{
    protected $fillable = [
        'user_id',
        'age',
        'height',
        'weight',
        'experience',
        'location',
        'latitude',
        'longitude',
        'portfolio_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
