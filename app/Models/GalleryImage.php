<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class GalleryImage extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'gallery_album_id',
        'path',
        'caption',
        'alt',
        'position',
        'is_visible',
    ];


    public array $translatable = ['caption', 'alt'];


    public function album()
    {
        return $this->belongsTo(GalleryAlbum::class, 'gallery_album_id');
    }
}
