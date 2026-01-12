<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class News extends Model
{
    use HasFactory, SoftDeletes, HasSlug;


    protected $fillable = [
    'title','slug','body','cover_image_path','is_published','published_at','created_by'
    ];


    protected $casts = [ 'published_at' => 'datetime', 'is_published' => 'boolean' ];


    public function getSlugOptions(): SlugOptions
    { return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug'); }


    public function author() { return $this->belongsTo(User::class, 'created_by'); }


    public function categories() { return $this->belongsToMany(Category::class, 'news_categories'); }
}
