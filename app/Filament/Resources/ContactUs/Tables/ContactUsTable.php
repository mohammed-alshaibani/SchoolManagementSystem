<?php

namespace App\Filament\Resources\ContactUs\Tables;

use App\Models\ContactUs;
use Filament\Actions\Action;
use Filament\Actions\Action as NotificationAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
// use Filament\Notifications\Actions\Action as NotificationAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ContactUsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultKeySort()
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->sortable()->toggleable(),
                TextColumn::make('subject')->limit(40)->searchable(),
                BadgeColumn::make('status')->colors([
                    'warning' => 'new',
                    'info' => 'in_progress',
                    'success' => 'closed',
                ])->sortable(),
                IconColumn::make('is_read')->boolean()->label('Read'),
                TextColumn::make('created_at')->since()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'new' => 'New',
                    'in_progress' => 'In Progress',
                    'closed' => 'Closed',
                ]),
                TernaryFilter::make('is_read')->label('Read'),
            ])
            

            // Group the core record actions at the end of each row
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),

                // keep your custom row action alongside the group
                Action::make('takeAndMarkRead')
                    ->label('Take & Mark as read')
                    ->tooltip('Assign to me, set In Progress, and mark as read')
                    ->icon('heroicon-o-user-plus')
                    ->requiresConfirmation()
                    ->visible(fn (ContactUs $record) => ! $record->is_read || ! $record->handled_by)
                    ->action(function (ContactUs $record): void {
                        $record->forceFill([
                            'is_read' => true,
                            'status' => $record->status === 'new' ? 'in_progress' : $record->status,
                            'handled_by' => auth()->id(),
                            'handled_at' => now(),
                        ])->save();

                        $url = \App\Filament\Resources\ContactUs\ContactUsResource::getUrl('view', ['record' => $record]);

                        Notification::make()
                            ->title('Assigned to you')
                            ->body("Contact from {$record->name} is now assigned to you.")
                            ->success()
                            ->actions([
                                NotificationAction::make('Open')->button()->url($url, shouldOpenInNewTab: false),
                                
                            ])
                            ->send();

                        if ($user = auth()->user()) {
                            Notification::make()
                                ->title('Contact assigned')
                                ->body("You took ownership of: {$record->subject}")
                                ->success()
                                ->sendToDatabase($user);
                        }
                    }),
            ])

            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }
}
