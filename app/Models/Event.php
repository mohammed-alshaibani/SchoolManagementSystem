<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug; use Spatie\Sluggable\SlugOptions;

class Event extends Model
{
    use HasFactory, SoftDeletes, HasSlug;
    protected $fillable = ['title','slug','body','event_date','location','is_published','created_by'];
    protected $casts = ['event_date'=>'date','is_published'=>'boolean'];
    public function getSlugOptions(): SlugOptions { return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug'); }
    public function author(){ return $this->belongsTo(User::class,'created_by'); }
}
