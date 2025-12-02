<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectHire extends Model
{
    protected $fillable = [
        'project_id',
        'recruiter_id',
        'model_id',
        'hire_date',
        'contract_file',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function recruiter()
    {
        return $this->belongsTo(User::class, 'recruiter_id');
    }

    public function model()
    {
        return $this->belongsTo(User::class, 'model_id');
    }
}
