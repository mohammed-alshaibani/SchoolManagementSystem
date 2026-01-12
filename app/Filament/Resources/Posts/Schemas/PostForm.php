<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Fieldset;

use Filament\Forms\Components\Textarea;
use Filament\Tables\Grouping\Group as GroupingGroup;

use function Laravel\Prompts\text;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                    Tabs::make('Create new Post')->tabs([
                        Tab::make('Details')->label(__('messages.details'))->icon('heroicon-m-inbox')->schema([
                            TextInput::make('title')
                                    ->label(__('messages.title'))
                                    ->required()
                                    ->minLength(3)
                                    ->maxLength(20),
                                TextInput::make('slug')
                                    ->label(__('messages.slug'))
                                    ->required()
                                    ->minLength(3)
                                    ->maxLength(20)
                                    ->helperText(__('messages.slug_helper')),
                            Select::make('category_id')
                                ->label(__('messages.category'))
                                ->preload()
                                ->relationship('category', 'name')
                                ->required()->searchable(),
                            ColorPicker::make('color')
                                ->label(__('messages.color'))
                                ->required(),
                        ]),
                        Tab::make('Content')->label(__('messages.content'))->icon('heroicon-o-document-text')->schema([
                            MarkdownEditor::make('content')
                                ->label(__('messages.content'))
                                ->required()->columnSpanFull(),
                                Group::make()->schema([
                                ]),


                            ]),


                        Tab::make('Meta')->label(__('messages.meta'))->icon('heroicon-o-document-text')->schema([
                            FileUpload::make('thumbnail')
                                ->label(__('messages.image'))
                                ->required()
                                
                                ->directory('post-images')
                                ->visibility('public')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1024')
                            ->imageResizeTargetHeight('1024')
                            ->maxSize((1024 * 1000))
                            ->disk('public')
                            ->imageEditor(),
                            Section::make('Additional Info')->schema([
                            TagsInput::make('tags')
                                ->label(__('messages.tags'))
                                ->required(),
                            Checkbox::make('is_published')
                                ->label(__('messages.published'))
                                ->default(false),

                            ])->columnSpan(1),
                            Section::make('Authors')->schema([
                            Select::make('users')
                                ->label(__('messages.authors'))
                                ->relationship('users', 'name')
                                ->multiple()
                                ->searchable()
                                ->preload()
                                ->required(),
                                // CheckboxList::make('users')
                                //     ->label('Authors')
                                //     ->relationship('users', 'name')
                                //     ->searchable()
                                // ->required(),

                            ])
                        ])
                        ])->columnSpanFull(),





                ])->columns([
                    'sm' => 2,
                    'lg' => 3,
                    'md' => 2,


                /************************************************** */
                
            ]);
    }
}
