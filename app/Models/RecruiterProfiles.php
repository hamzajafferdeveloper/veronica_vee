<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecruiterProfiles extends Model
{
    protected $fillable = [
        'user_id',
        'avatar',
        'company_name',
        'designation',
        'phone',
        'address',
        'latitude',
        'longitude',
        'bio',
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
