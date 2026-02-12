<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        // Primary Information
        'name',
        'name_bangla',
        'short_form',
        'motto',
        'medium',
        'establish_year',
        'eiin',
        'mpo_code',
        'institute_code',
        'institute_type',
        'board',
        'affiliation',
        'logo',
        'favicon',
        
        // Contact Information
        'telephone',
        'mobile',
        'fax',
        'office_hours',
        'website_url',
        'email',
        'address',
        'google_map_embed',
        
        // Social Networks
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'youtube',
        'whatsapp',
        'tiktok',
        'telegram',
    ];

    protected $casts = [
        'establish_year' => 'integer',
    ];
}
