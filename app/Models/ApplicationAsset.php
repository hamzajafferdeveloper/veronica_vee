<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationAsset extends Model
{
    protected $table = 'applications_assets';

    protected $fillable = [
        'application_id',
        'url',
        'asset_type',
        'asset_extension',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
