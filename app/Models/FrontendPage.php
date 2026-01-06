<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontendPage extends Model
{
    protected $fillable = [
        'title', 'slug', 'content',
    ];
}
