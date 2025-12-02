<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectApplication extends Model
{
    protected $fillable = [
        'project_id',
        'model_id',
        'status',
        'notes'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function model()
    {
        return $this->belongsTo(User::class, 'model_id');
    }
}
