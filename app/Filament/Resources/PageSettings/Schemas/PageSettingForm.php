<?php

namespace App\Filament\Resources\PageSettings\Schemas;

// use Filament\Schemas\Schema;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Guava\IconPicker\Forms\Components\IconPicker;

class PageSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('About Sections')->tabs([
                    Tab::make('Mission')
                        ->schema([
                            TextInput::make('mission_title')->label('Title')->default('Our Mission')->required(),
                            MarkdownEditor::make('mission_body')->label('Body')->columnSpanFull()->required(),
                        ])->columns(['md' => 2]),


                    Tab::make('Vision')
                        ->schema([
                            TextInput::make('vision_title')->label('Title')->default('Our Vision')->required(),
                            MarkdownEditor::make('vision_body')->label('Body')->columnSpanFull()->required(),
                        ])->columns(['md' => 2]),


                    Tab::make('Strategic Goals')
                        ->schema([
                            TextInput::make('goals_title')->label('Section title')->default('Strategic Goals')->required(),
                            Repeater::make('strategic_goals')
                                ->addActionLabel('Add goal')
                                ->reorderable()
                                ->collapsed()
                                ->schema([
                                    TextInput::make('title')->required()->maxLength(120),
                                    Textarea::make('description')->rows(3)->maxLength(500)->columnSpanFull(),
                                    // Better icon picker
                                    IconPicker::make('icon')
                                    ->label('Icon')
                                    ->sets(['heroicons']) // limit to built-in heroicons
                                    ->iconsSearchResults(true) // compact grid with tooltip
                                    ->searchable()
                                    ->nullable()
                                    ->hint('Pick a Heroicon (optional).'),
                                ])
                                ->minItems(1)
                                ->maxItems(12)
                                ->columnSpanFull(),
                        ]),


                    Tab::make('Unique Features')
                        ->schema([
                            TextInput::make('features_title')->label('Section title')->default('Unique Features')->required(),
                            Repeater::make('unique_features')
                                ->addActionLabel('Add feature')
                                ->reorderable()
                                ->collapsed()
                                ->schema([
                                    TextInput::make('title')->required()->maxLength(120),
                                    Textarea::make('description')->rows(3)->maxLength(500)->columnSpanFull(),
                                    // TextInput::make('icon')->placeholder('e.g. heroicon-o-sparkles')
                                    //     ->helperText('Optional icon class to use on the front-end.'),
                                    IconPicker::make('icon')
                                    ->label('Icon')
                                    ->sets(['heroicons'])
                                    ->iconsSearchResults(true)
                                    ->searchable()
                                    ->nullable()
                                    ->hint('Pick a Heroicon (optional).'),
                                ])
                                ->minItems(1)
                                ->maxItems(12)
                                ->columnSpanFull(),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
