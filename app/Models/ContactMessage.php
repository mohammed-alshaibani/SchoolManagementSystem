<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactMessage extends Model
{
    use HasFactory;
    protected $fillable = ['sender_name','sender_email','sender_phone','message','status','received_at','replied_by','replied_at','reply_note'];
    protected $casts = ['received_at'=>'datetime','replied_at'=>'datetime'];
    public function replier(){ return $this->belongsTo(User::class,'replied_by'); }
}
