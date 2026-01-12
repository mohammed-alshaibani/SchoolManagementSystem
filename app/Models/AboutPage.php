<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class AboutPage extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'subtitle',
        'body',
        'hero_image',
        'contact_email',
        'phone',
        'meta_title',
        'meta_description',
        'published',
    ];


    protected $casts = [
        'published' => 'bool',
    ];
}
