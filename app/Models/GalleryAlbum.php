<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;


class GalleryAlbum extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;
    protected $fillable = [
        'slug',
        'title',
        'description',
        'cover_image',
        'is_published',
        'published_at',
    ];


    public array $translatable = ['title', 'description'];


    public function images()
    {
        return $this->hasMany(GalleryImage::class)->orderBy('position');
    }


    // Why: quick accessor to show localized title in Filament table
    public function getTitleLocalizedAttribute(): string
    {
        $loc = app()->getLocale();
        return (string) ($this->getTranslations('title')[$loc] ?? $this->getTranslations('title')['en'] ?? '');
    }
}