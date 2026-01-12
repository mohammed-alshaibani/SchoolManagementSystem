<?php

namespace App\Filament\Resources\Categories\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\MarkdownEditor;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                    // Group::make()
                    //     ->schema([
                            TextInput::make('title')
                                ->label('Title')
                                ->required()
                                ->minLength(3)
                                ->maxLength(20),
                            TextInput::make('slug')
                                ->label('Slug')
                                ->required()
                                // ->unique()
                                ->minLength(3)
                                ->maxLength(20),
                        // ]),
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required()->searchable(),
                ColorPicker::make('color')
                    ->label('Color')
                    ->required(),
                MarkdownEditor::make('content')
                    ->label('Content')
                    ->required()->columnSpanFull(),
                
                
                
                    FileUpload::make('thumbnail')
                        ->label('Image')
                        ->required()
                        ->directory('post-images')
                        ->visibility('public')
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('16:9')
                        ->imageResizeTargetWidth('1024')
                        ->imageResizeTargetHeight('1024')
                        ->maxSize((1024 * 1000))
                        ->disk('public'),
                

                
                    TagsInput::make('tags')
                        ->label('Tags')
                        ->required(),
                    Checkbox::make('is_published')
                        ->label('Published')
                        ->default(false),
                
                
                    Select::make('users')
                        ->label('Authors')
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

                

            ]);
        }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('tags')
                    ->label('Tags')->sortable()
                    ->toggleable(),
                
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
