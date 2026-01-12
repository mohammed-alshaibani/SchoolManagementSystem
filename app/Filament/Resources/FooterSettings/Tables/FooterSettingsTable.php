<?php

namespace App\Filament\Resources\FooterSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class FooterSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
           ->defaultKeySort()
            ->columns([
                TextColumn::make('title_contact')->label('Contact Title')->limit(20),
                TextColumn::make('email')->limit(20),
                TextColumn::make('phone')->limit(20),
                TextColumn::make('updated_at')->since()->label('Updated'),
            ])
            ->actions([
                EditAction::make(),
                // no DeleteAction
            ])
            ->bulkActions([]); // none
    }
}
