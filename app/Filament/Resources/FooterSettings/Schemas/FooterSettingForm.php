<?php

namespace App\Filament\Resources\FooterSettings\Schemas;


use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Fieldset;

class FooterSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('footer_settings')
                    ->tabs([
                        Tab::make('Contact')
                            ->schema([
                                Fieldset::make('Contact Information')
                                    ->schema([
                                        TextInput::make('title_contact')
                                            ->label('Section title')
                                            ->default('Get In Touch')
                                            ->required(),
                                        TextInput::make('address')->maxLength(190),
                                        TextInput::make('phone')->maxLength(40),
                                        TextInput::make('email')->email()->maxLength(190),
                                        Fieldset::make('Social Links')
                                            ->schema([
                                                TextInput::make('facebook_url')->placeholder('https://facebook.com/...'),
                                                TextInput::make('twitter_url')->placeholder('https://twitter.com/...'),
                                                TextInput::make('youtube_url')->placeholder('https://youtube.com/...'),
                                                TextInput::make('linkedin_url')->placeholder('https://linkedin.com/...'),
                                            ])->columns(['md' => 2])
                                            ->columnSpanFull(),
                                    ])->columns(['md' => 2]),
                            ])
                            ->columns(['md' => 2]),

                        Tab::make('Quick Links')
                            ->schema([
                                TextInput::make('title_links')
                                    ->label('Section title')
                                    ->default('Quick Links')
                                    ->required(),
                                Repeater::make('quick_links')
                                    ->schema([
                                        TextInput::make('label')->required()->maxLength(50),
                                        TextInput::make('url')->required()->maxLength(255),
                                    ])
                                    ->minItems(1)
                                    ->maxItems(6)
                                    ->reorderable()
                                    ->addActionLabel('Add link')
                                    ->columnSpanFull(),
                            ])
                            ->columns(['md' => 2]),

                        Tab::make('Photo Gallery')
                            ->schema([
                                TextInput::make('title_gallery')
                                    ->label('Section title')
                                    ->default('Photo Gallery')
                                    ->required(),
                                FileUpload::make('gallery')
                                    ->image()
                                    ->multiple()
                                    ->maxFiles(6)
                                    ->reorderable()
                                    ->directory('footer/gallery')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->imageEditor()
                                    ->columnSpanFull(),
                            ])
                            ->columns(['md' => 2]),

                        Tab::make('Newsletter')
                            ->schema([
                                TextInput::make('title_newsletter')
                                    ->label('Section title')
                                    ->default('Newsletter')
                                    ->required(),
                                Textarea::make('newsletter_text')->rows(3),
                                TextInput::make('newsletter_placeholder')->default('Your email'),
                                TextInput::make('newsletter_button')->default('SignUp'),
                            ])
                            ->columns(['md' => 2]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}

