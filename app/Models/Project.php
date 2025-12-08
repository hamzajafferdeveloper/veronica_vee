<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'recruiter_id',
        'image',
        'document',
        'title',
        'slug',
        'description',
        'category_id',
        'budget',
        'deadline',
        'status'
    ];

    public function recruiter()
    {
        return $this->belongsTo(User::class, 'recruiter_id');
    }

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }
}
