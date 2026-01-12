<?php


namespace App\Filament\Resources\ContactUs\Pages;


use App\Filament\Resources\ContactUs\ContactUsResource;
use App\Models\ContactUs;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;


class ListContactUs extends ListRecords
{
protected static string $resource = ContactUsResource::class;


    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }

    


/**
* Small helper so all tabs poll every 10s (keeps badges fresh).
*/
    private function pollAttrs(): array
    {
        return ['wire:poll.10s' => ''];
    }


    public function getTabs(): array
    {
        return [
            'All' => Tab::make()
                ->extraAttributes($this->pollAttrs())
                ->badge(fn (): int => ContactUs::count()),


            'Unread' => Tab::make()
                ->extraAttributes($this->pollAttrs())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_read', false))
                ->badge(fn (): int => ContactUs::where('is_read', false)->count())
                ->badgeColor('danger'),


            'New' => Tab::make()
                ->extraAttributes($this->pollAttrs())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'new'))
                ->badge(fn (): int => ContactUs::where('status', 'new')->count())
                ->badgeColor('warning'),


            'In Progress' => Tab::make()
                ->extraAttributes($this->pollAttrs())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'in_progress'))
                ->badge(fn (): int => ContactUs::where('status', 'in_progress')->count())
                ->badgeColor('info'),


            'Closed' => Tab::make()
                ->extraAttributes($this->pollAttrs())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'closed'))
                ->badge(fn (): int => ContactUs::where('status', 'closed')->count())
                ->badgeColor('success'),
        ];
    }
}