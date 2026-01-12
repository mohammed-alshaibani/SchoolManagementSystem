<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteFooterSetting extends Model
{
    use HasFactory;


    protected $table = 'site_footer_settings';


    protected $fillable = [
        'title_contact',
        'title_links',
        'title_gallery',
        'title_newsletter',
        'address',
        'phone',
        'email',
        'facebook_url',
        'twitter_url',
        'youtube_url',
        'linkedin_url',
        'quick_links',
        'gallery',
        'newsletter_text',
        'newsletter_placeholder',
        'newsletter_button',
    ];


    protected $casts = [
        'quick_links' => 'array',
        'gallery' => 'array',
    ];
}
