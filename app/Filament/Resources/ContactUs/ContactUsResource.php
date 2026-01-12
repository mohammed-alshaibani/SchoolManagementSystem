<?php

namespace App\Filament\Resources\ContactUs;

use App\Filament\Resources\ContactUs\Pages\CreateContactUs;
use App\Filament\Resources\ContactUs\Pages\EditContactUs;
use App\Filament\Resources\ContactUs\Pages\ListContactUs;
use App\Filament\Resources\ContactUs\Schemas\ContactUsForm;
use App\Filament\Resources\ContactUs\Tables\ContactUsTable;
use App\Models\ContactUs;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactUsResource extends Resource
{
    protected static ?string $model = ContactUs::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Inbox;

    protected static ?string $recordTitleAttribute = 'Contact Us';
    protected static string|\UnitEnum|null $navigationGroup = 'Setting';
    

    protected static ?string $pluralLabel = 'Contacts';

    public static function getNavigationLabel(): string
    {
        return __('messages.posts');
    }

    protected static ?int $navigationSort = 99;

    public static function form(Schema $schema): Schema
    {
        return ContactUsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactUsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactUs::route('/'),
            'create' => CreateContactUs::route('/create'),
            'edit' => EditContactUs::route('/{record}/edit'),
            'view' => Pages\ViewContactUs::route('/{record}')
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
