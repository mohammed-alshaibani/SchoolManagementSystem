<?php

namespace App\Filament\Resources\Facilities\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Support\Icons\Heroicon;

use Filament\Schemas\Schema;

class FacilityForm
{
    public static function configure(Schema $schema): Schema
    {

    
        return $schema
            ->components([
                TextInput::make('title')
                ->required()
                ->maxLength(255),
                Textarea::make('description')
                ->rows(3),
                
                Select::make('color')
                ->options([
                    'primary' => 'Primary',
                    'success' => 'Success',
                    'warning' => 'Warning',
                    'info' => 'Info',
                    'danger' => 'Danger',
                ])
                ->default('primary'),
            ]);
    }
}
