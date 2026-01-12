<?php

namespace App\Filament\Resources\AboutPages\Schemas;

use App\Filament\Resources\AboutPageResource\Pages;
use App\Models\AboutPage;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;

class AboutPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('About Us')->tabs([
                    Tab::make('Content')->schema([
                        TextInput::make('title')->required()->maxLength(140),
                        TextInput::make('subtitle')->maxLength(200),
                        MarkdownEditor::make('body')->required()->columnSpanFull(),
                    ])->columns(['md' => 2]),


                    Tab::make('Media')->schema([
                        FileUpload::make('hero_image')
                            ->image()
                            ->directory('about')
                            ->disk('public')
                            ->visibility('public')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('21:9')
                            ->imageResizeTargetWidth(1920)
                            ->columnSpanFull(),
                    ]),


                    Tab::make('Contact')->schema([
                        TextInput::make('contact_email')->email(),
                        TextInput::make('phone')->tel(),
                        Toggle::make('published')->default(true)->inline(false),
                    ])->columns(['md' => 2]),


                    Tab::make('SEO')->schema([
                        TextInput::make('meta_title')->maxLength(70),
                        Textarea::make('meta_description')->rows(3)->maxLength(300),
                    ])->columns(['md' => 2]),
                ])->columnSpanFull(),
            ]);
    }
}
