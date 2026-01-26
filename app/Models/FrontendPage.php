<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontendPage extends Model
{
    protected $fillable = [
        'title', 'slug', 'content',
    ];

    public function translations()
    {
        return $this->hasMany(FrontendPageTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return $this->translations->where('locale', $locale)->first();
    }
}
