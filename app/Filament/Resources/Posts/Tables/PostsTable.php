<?php

namespace App\Filament\Resources\Posts\Tables;

use Dom\Text;
use Faker\Provider\Image;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\ExportAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Table;
use App\Filament\Exports\ProductExporter;
use Filament\Actions\ViewAction;
use Filament\Schemas\Components\View;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use PhpParser\Node\Expr\Ternary;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('title')

                    ->label(__('messages.title'))->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label(__('messages.category'))
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                ColorColumn::make('color')
                    ->label(__('messages.color'))
                    ->toggleable(),
                TextColumn::make('tags')
                    ->label(__('messages.tags'))->sortable()
                    ->toggleable(),
                CheckboxColumn::make('is_published')
                    ->label(__('messages.published'))
                    ->toggleable(),
                ImageColumn::make('thumbnail')
                    ->label(__('messages.thumbnail'))
                    ->toggleable()
                    ->disk('public'),
                TextColumn::make('created_at')
                    ->label(__('messages.created_at'))
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
            ])
            ->filters([
                // Filter::make('Published Posts')->query(fn ($query) => $query->where('is_published', true)),
                // Filter::make('Unpublished Posts')->query(fn ($query) => $query->where('is_published', false)),
                TernaryFilter::make('is_published'),
                SelectFilter::make('Category')
                ->relationship('category', 'name')
                ->preload()
                ->searchable(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                ViewAction::make(),
                // ReplicateAction::make(),
                // ExportAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
