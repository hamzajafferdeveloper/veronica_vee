<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecruiterProfiles extends Model
{
    protected $fillable = [
        'user_id',
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
}
