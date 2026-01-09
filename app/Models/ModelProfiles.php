<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelProfiles extends Model
{
    protected $fillable = [
        'user_id',
        'avatar',
        'age',
        'height',
        'weight',
        'experience',
        'location',
        'latitude',
        'longitude',
        'portfolio_url',
        'ordering'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
