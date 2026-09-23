<?php

namespace App\Filament\Resources\Demos;

use App\Filament\Resources\Demos\Pages\CreateDemo;
use App\Filament\Resources\Demos\Pages\EditDemo;
use App\Filament\Resources\Demos\Pages\ListDemos;
use App\Filament\Resources\Demos\Schemas\DemoForm;
use App\Filament\Resources\Demos\Tables\DemosTable;
use App\Models\Demo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DemoResource extends Resource
{
    protected static ?string $model = Demo::class;

    protected static ?string $navigationLabel = 'Démos';

    protected static ?string $modelLabel = 'Démo';

    protected static ?string $pluralModelLabel = 'Démos';

    protected static ?int $navigationSort = 30;

    protected static string|UnitEnum|null $navigationGroup = 'Contenu';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedComputerDesktop;

    public static function form(Schema $schema): Schema
    {
        return DemoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DemosTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDemos::route('/'),
            'create' => CreateDemo::route('/create'),
            'edit' => EditDemo::route('/{record}/edit'),
        ];
    }
}
