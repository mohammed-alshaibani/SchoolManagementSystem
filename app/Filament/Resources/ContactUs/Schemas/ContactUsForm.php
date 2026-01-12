<?php

namespace App\Filament\Resources\ContactUs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactUsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)->components([
                    Section::make('Sender')
                        ->columns(2)
                        ->components([
                            TextInput::make('name')->disabledOn('edit')->required(),
                            TextInput::make('email')->email()->disabledOn('edit')->required(),
                            TextInput::make('phone')->tel()->disabledOn('edit'),
                            TextInput::make('subject')->disabledOn('edit')->columnSpanFull(),
                        ])->columnSpan(2),


                    Section::make('Message')
                        ->components([
                            RichEditor::make('message')->toolbarButtons(['bold', 'italic', 'blockquote', 'codeBlock'])->disabledOn('edit')->columnSpanFull(),
                        ])->columnSpan(2),


                    Section::make('Handling')
                        ->columns(3)
                        ->components([
                            Select::make('status')
                                ->options([
                                    'new' => 'New',
                                    'in_progress' => 'In Progress',
                                    'closed' => 'Closed',
                                ])->required(),


                            Toggle::make('is_read')->label('Read'),


                            Select::make('handled_by')
                                ->label('Assignee')
                                ->relationship('handler', 'name')
                                ->searchable()
                                ->preload(),
                        ])->columnSpan(2),
                ]),
            ]);
    }
    
}
