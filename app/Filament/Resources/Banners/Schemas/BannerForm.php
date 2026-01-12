<?php

namespace App\Filament\Resources\Banners\Schemas;

use Dom\Text;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Symfony\Component\Console\Input\Input;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('banner_type')
                ->options([
                    'HomePage' => 'HomePage',
                ])->required()->label('Banner Type'),

                TextInput::make('slug')
                ->label('title'),
                FileUpload::make('path')->required()
                ->directory('form-attachments')
                ->visibility('public')
                ->imageResizeMode('cover')
                ->imageEditor()
                ->imageCropAspectRatio('16:9')
                ->imageResizeTargetWidth('1920')
                ->imageResizeTargetHeight('1080')
                ->maxSize((1024 * 1000))
                ->disk('public'),
                TextInput::make('content')->label('Content'),
                TextInput::make('text')->label('Text'),
            ]);
    }
}
