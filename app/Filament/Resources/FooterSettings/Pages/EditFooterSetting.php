<?php

namespace App\Filament\Resources\FooterSettings\Pages;

use App\Filament\Resources\FooterSettings\FooterSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\CreateAction;
use App\Models\SiteFooterSetting as FooterSetting;

class EditFooterSetting extends EditRecord
{
    protected static string $resource = FooterSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Footer saved';
    }
    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()
                ->label('Save changes')
                ->requiresConfirmation()
                ->modalHeading('Save footer settings?')
                ->modalSubmitActionLabel('Yes, save')
                ->modalCancelActionLabel('Cancel'),
        ];
    }
    protected function canDelete(): bool
    {
        return false;
    }
    
}
