<?php

namespace App\Filament\Resources\ContactUs\Pages;


use App\Filament\Resources\ContactUs\ContactUsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Customers\Actions\EmailCustomerAction;


class ViewContactUs extends ViewRecord
{
    protected static string $resource = ContactUsResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            // EmailCustomerAction::make(),
        ];
    }
}