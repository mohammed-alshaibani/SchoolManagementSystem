<?php

namespace App\Filament\Resources\FooterSettings\Pages;

use App\Filament\Resources\FooterSettings\FooterSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\CreateRecord;
use App\Models\SiteFooterSetting as FooterSetting;

class ListFooterSettings extends ListRecords
{
    protected static string $resource = FooterSettingResource::class;

    public function mount(): void
    {
        $record = FooterSetting::first() ?? FooterSetting::create();
        $this->redirect(FooterSettingResource::getUrl('edit', ['record' => $record]));
    }


    protected function getHeaderActions(): array
    {
        return []; // no create
    }
}
