<?php

namespace App\Filament\Resources\GalleryAlbums\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;

class GalleryAlbumsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultKeySort()
            ->columns([
                ImageColumn::make('cover_image')->label('Cover')->disk('public')->square()->height(48),
                TextColumn::make('title_localized')->label('Title')->searchable(),
                TextColumn::make('slug')->toggleable(),
                IconColumn::make('is_published')->boolean(),
                TextColumn::make('updated_at')->since()->label('Updated'),
            ])
            ->filters([
                TernaryFilter::make('is_published')->label('Published'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
