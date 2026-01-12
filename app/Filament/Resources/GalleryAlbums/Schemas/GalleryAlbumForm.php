<?php

namespace App\Filament\Resources\GalleryAlbums\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Group;

class GalleryAlbumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Album')->tabs([
                    Tab::make('Details')->schema([
                        TextInput::make('slug')->unique(ignoreRecord: true)->required()->helperText('Unique URL key'),


                        // Title (EN/AR) — nested state under "title"
                        Fieldset::make('Title')->schema([
                            TextInput::make('en')->label('Title (EN)')->required(),
                            TextInput::make('ar')->label('Title (AR)')->required(),
                        ])->columns(2)->statePath('title'),


                        // Description (EN/AR)
                        Fieldset::make('Description')->schema([
                            Textarea::make('en')->label('Description (EN)')->rows(4),
                            Textarea::make('ar')->label('Description (AR)')->rows(4),
                        ])->columns(2)->statePath('description'),


                        FileUpload::make('cover_image')
                            ->image()->disk('public')->directory('gallery/albums')->visibility('public')
                            ->imageEditor()->columnSpanFull(),


                        Fieldset::make('Publishing')->schema([
                            Toggle::make('is_published')->inline(false)->default(true),
                            DateTimePicker::make('published_at')->seconds(false),
                        ])->columns(2),
                    ])->columns(['md' => 2]),


                    Tab::make('Images')->schema([
                        Section::make('Album Images')->schema([
                            Repeater::make('images')->relationship()->orderable('position')->reorderableWithDragAndDrop()
                                ->defaultItems(0)->addActionLabel('Add image')->schema([
                                    FileUpload::make('path')->label('Image')->image()->disk('public')
                                        ->directory('gallery/items')->visibility('public')->imageEditor()->required(),


                                    Group::make()->schema([
                                        TextInput::make('en')->label('Caption (EN)')->maxLength(120),
                                        TextInput::make('ar')->label('Caption (AR)')->maxLength(120),
                                    ])->columns(2)->statePath('caption'),


                                    Group::make()->schema([
                                        TextInput::make('en')->label('Alt (EN)')->maxLength(120),
                                        TextInput::make('ar')->label('Alt (AR)')->maxLength(120),
                                    ])->columns(2)->statePath('alt'),


                                    Toggle::make('is_visible')->inline(false)->default(true),
                                ])->columnSpanFull(),
                        ])->columnSpanFull(),
                    ])->columns(1),
                ])->columnSpanFull(),
            ]);
    }
}
