<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
protected $fillable = ['name','type','slug'];


    public function news() { return $this->belongsToMany(News::class, 'news_categories'); }
    public function albums() { return $this->hasMany(GalleryAlbum::class, 'category_id'); }


    public function scopeType($q, $type) { return $q->where('type', $type); }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
