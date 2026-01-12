<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('messages.name'))
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $state, string $operation, Set $set) {
                        // Handle the state update
                        $set('slug', Str::slug($state));

                    }),
                TextInput::make('type')
                    ->label(__('messages.type'))
                    ->default(null),
                TextInput::make('slug')
                    ->label(__('messages.slug'))
                    ->required()
                    ->readOnly()
                    
                    ->helperText('This field is automatically generated from the name.')
            ]);
    }
    
}
