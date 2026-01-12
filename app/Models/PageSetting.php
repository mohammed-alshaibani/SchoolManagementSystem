<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageSetting extends Model
{
    use HasFactory;


    protected $fillable = [
        'mission_title',
        'mission_body',
        'vision_title',
        'vision_body',
        'goals_title',
        'strategic_goals',
        'features_title',
        'unique_features',
    ];


    protected $casts = [
        'strategic_goals' => 'array',
        'unique_features' => 'array',
    ];
}
