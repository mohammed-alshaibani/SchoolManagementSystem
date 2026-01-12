<?php

namespace App\Filament\Resources\FooterSettings;

use App\Filament\Resources\FooterSettings\Pages\CreateFooterSetting;
use App\Filament\Resources\FooterSettings\Pages\EditFooterSetting;
use App\Filament\Resources\FooterSettings\Pages\ListFooterSettings;
use App\Filament\Resources\FooterSettings\Schemas\FooterSettingForm;
use App\Filament\Resources\FooterSettings\Tables\FooterSettingsTable;
use App\Models\SiteFooterSetting as FooterSettingModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FooterSettingResource extends Resource
{
    protected static ?string $model = FooterSettingModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;
    // protected static string|BackedEnum|null $navigationGroup = 'Settings';

    protected static ?string $pluralLabel = 'Footer Settings';
    protected static ?int $navigationSort = 99;

    protected static string|\UnitEnum|null $navigationGroup = 'Setting';    

    protected static ?string $recordTitleAttribute = 'Footer Setting';
    public static function getNavigationLabel(): string
    {
        return __('messages.footer_settings');
    }
    
    public static function form(Schema $schema): Schema
    {
        return FooterSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FooterSettingsTable::configure($table);
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
            'index' => ListFooterSettings::route('/'),
            'create' => CreateFooterSetting::route('/create'),
            'edit' => EditFooterSetting::route('/{record}/edit'),
        ];
    }
    public static function getNavigationUrl(): string
    {
        $id = FooterSettingModel::query()->value('id')
            ?? FooterSettingModel::query()->create([])->getKey();


        return static::getUrl('edit', ['record' => $id]);
    }
}
