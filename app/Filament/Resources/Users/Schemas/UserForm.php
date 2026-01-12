<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get; // correct Get for Schemas
use Illuminate\Validation\Rules\Password as PasswordRule;
use Filament\Forms\Components\FileUpload;

class UserForm
{
    /**
     * Two-column layout inside tabs.
     * - Details tab: name + email side-by-side on md+ screens
     * - Security tab: current_password full width; new + confirm side-by-side
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('information')
                    ->tabs([
                        Tab::make('Details')->label(__('messages.details'))
                            ->icon('heroicon-m-inbox')
                            ->schema([
                                TextInput::make('name')->label(__('messages.name'))
                                    ->required(),

                                TextInput::make('email')->label(__('messages.email'))
                                    ->email()
                                    ->required(),
                                // Assign one or many roles
                                Select::make('roles')
                                    ->label(__('messages.roles'))
                                    ->relationship('roles', 'name') // Spatie HasRoles relation
                                    ->multiple()
                                    ->preload()
                                    ->searchable()
                                    ->native(false)
                                    // ->disabledOn('edit')
                                    ->disabled(fn (): bool => ! auth()->user()?->hasRole('Admin'))

                                ->helperText(__('messages.select_admin_editor_or_viewer')),

                            ])
                            ->columns(['md' => 3]) // two columns from md+
                            ->columnSpan(2),
                            Tab::make('Profile')
                                ->label(__('messages.profile'))
                                ->icon('heroicon-o-user-circle')
                                ->schema([
                                    TextInput::make('username')->label(__('messages.username'))
                                        ->maxLength(30)
                                        ->unique(ignoreRecord: true)
                                        ->helperText('' . __('messages.username_helper')),
                                    FileUpload::make('avatar')
                                        ->label(__('messages.avatar'))
                                        ->image()
                                        ->avatar()
                                        ->directory('avatars')
                                        ->imageEditor()
                                        ->imageResizeMode('cover')
                                        ->imageCropAspectRatio('1:1')
                                        ->maxSize(1024)
                                        ->visibility('public') // change to private if you prefer
                                        ->columnSpanFull()
                                        ->helperText(__('messages.recommended_size'))
                                        // adjust disk as needed
                                        ->disk('public') // <-- important
                                        ->visibility('public'),
                            ])
                            ->columns(['md' => 2]),

                        Tab::make('Security')->label(__('messages.security'))
                            ->icon('heroicon-o-lock-closed')
                            ->schema([
                                TextInput::make('current_password')
                                    ->label(__('messages.current_password'))
                                    ->password()
                                    ->revealable()
                                    ->autocomplete('current-password')
                                    ->rules(['current_password'])
                                    ->required(fn (Get $get): bool => filled($get('password')))
                                    ->dehydrated(false)
                                    ->hiddenOn('create')
                                    ->columnSpanFull(), // full row

                                TextInput::make('password')
                                    ->label(__('messages.new_password'))
                                    ->password()
                                    ->revealable()
                                    ->autocomplete('new-password')
                                    ->rule(PasswordRule::default())
                                    ->minLength(8)
                                    ->dehydrated(fn ($state): bool => filled($state))
                                    ->nullable(),

                                TextInput::make('password_confirmation')
                                    ->label(__('messages.confirm_new_password'))
                                    ->password()
                                    ->revealable()
                                    ->autocomplete('new-password')
                                    ->same('password')
                                    ->required(fn (Get $get): bool => filled($get('password')))
                                    ->dehydrated(false),
                            ])
                            ->columns(['md' => 2]) // two columns for new + confirm
                            ,
                    ])
                    ->columnSpanFull(),
            ])
            ->columns([
                'sm' => 2,
                'md' => 2,
                'lg' => 3,
            ]);
    }
}
