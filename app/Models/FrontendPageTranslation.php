<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontendPageTranslation extends Model
{
    protected $fillable = [
        'frontend_page_id',
        'locale',
        'title',
        'content',
    ];

    public function page()
    {
        return $this->belongsTo(FrontendPage::class);
    }
}
