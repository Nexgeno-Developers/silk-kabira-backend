<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'logo', 'email', 'phone', 'whatsapp',
        'address', 'website', 'google_map', 'is_active',
        'short_description', 'copyright_text',
        'catalogue', 'sample',
        'cta_title', 'cta_subtitle', 'meta_title', 'meta_description',
    ];

    public function meta()
    {
        return $this->hasMany(CompanyMeta::class);
    }
}
