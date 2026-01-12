<?php

namespace App\Filament\Resources\FooterSettings\Pages;

use App\Filament\Resources\FooterSettings\FooterSettingResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\SiteFooterSetting as FooterSetting;
use Filament\Actions\CreateAction;
class CreateFooterSetting extends CreateRecord
{
    protected static string $resource = FooterSettingResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Footer created';
    }
}
