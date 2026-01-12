<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Filament\Notifications\Actions\Action as NotificationAction;
use Filament\Actions\Action as NotificationAction;
class ContactUs extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contact_us';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'is_read',
        'handled_by',
        'handled_at',
    ];
    protected $casts =[
        'is_read' => 'boolean',
        'handled_at' => 'datetime',
    ];

    public function handler()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    protected static function booted(): void
    {
        static::created(function (self $record): void {
            // Fan-out DB notifications to all Admins
            $admins = \App\Models\User::role('Admin')->get();
            if ($admins->isEmpty()) {
                return;
            }


            $url = \App\Filament\Resources\ContactUs\ContactUsResource::getUrl('view', ['record' => $record]);


            Notification::make()
                ->title('New contact received')
                ->body("From {$record->name}: {$record->subject}")
                ->icon('heroicon-o-inbox')
                ->actions([
                    NotificationAction::make('Open')
                        ->button()
                        ->url($url, shouldOpenInNewTab: false),
                ])
                ->sendToDatabase($admins); // bell shows this on next poll
        });
    }
}
