<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffMember extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['full_name','role_title','bio','photo_path','department_id','is_visible','sort_order'];
    public function department(){ return $this->belongsTo(Department::class); }
}
