<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Tabs;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
             __('messages.all_posts') => Tab::make() ->badge(fn (): int => PostResource::getModel()::count()),
             __('messages.published') => Tab::make()->badge(fn (): int => PostResource::getModel()::where('is_published', true)->count())->modifyQueryUsing(function ($query) {
                return $query->where('is_published', true);
            }),
            __('messages.not_published') => Tab::make()
                ->badge(fn (): int => PostResource::getModel()::where('is_published', false)->count())
                ->modifyQueryUsing(fn ($query) => $query->where('is_published', false)),
        ];
    }
}
