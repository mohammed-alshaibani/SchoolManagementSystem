<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminPanel extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $arrpost=array();
        for($i=0;$i<Post::count();$i++){
            $arrpost[]=$i;
        }
        $arrcategory=array();
        for($i=0;$i<Category::count();$i++){
            $arrcategory[]=$i;
        }
        return [
            Stat::make('Users', User::count())
                ->description('Total Users')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('success')
                ->value(User::count()),
            Stat::make('Posts',Post::count())
                ->description('Total Posts')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('primary')
                ->value(Post::count())
                ->extraAttributes(['class' => 'animate-pulse'])
                ->chart($arrpost ),
            Stat::make('Categories',Category::class)
                ->description('Total Categories')
                ->descriptionIcon('heroicon-o-tag')
                ->color('warning')
                ->value(Category::count())
                ->chart($arrcategory),
        ];
    }
}
