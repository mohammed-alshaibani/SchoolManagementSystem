<?php

namespace App\Filament\Resources\Posts;

use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Posts\RelationManagers\UsersRelationManager;
use App\Filament\Resources\Posts\Schemas\PostForm;
use App\Filament\Resources\Posts\Tables\PostsTable;
use App\Models\Post;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Navigation\NavigationGroup ;
use UnitEnum;
class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Newspaper;

    protected static ?string $recordTitleAttribute = 'title';
    // protected static string | UnitEnum | null $navigationGroup = 'Media Center' ;
    public static function getNavigationGroup(): ?string
{
    return __('messages.media_center'); // your translation key
}
    protected static ?int $navigationSort = 1;
    // protected static string | UnitEnum | null $navigationParentItem = 'Media Center' ;
    // protected static ?string $navigationParentItem = 'Notifications';

    public static function getNavigationLabel(): string
    {
        return __('messages.posts');
    }

    public static function form(Schema $schema): Schema
    {
        return PostForm::configure($schema);
        
    }

    public static function table(Table $table): Table
    {
        return PostsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
            'view' => Pages\ViewPost::route('/{record}'),
        ];
    }
}
