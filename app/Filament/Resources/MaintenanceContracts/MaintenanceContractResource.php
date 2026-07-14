<?php

namespace App\Filament\Resources\MaintenanceContracts;

use App\Filament\Resources\MaintenanceContracts\Pages\CreateMaintenanceContract;
use App\Filament\Resources\MaintenanceContracts\Pages\EditMaintenanceContract;
use App\Filament\Resources\MaintenanceContracts\Pages\ListMaintenanceContracts;
use App\Filament\Resources\MaintenanceContracts\Schemas\MaintenanceContractForm;
use App\Filament\Resources\MaintenanceContracts\Tables\MaintenanceContractsTable;
use App\Models\MaintenanceContract;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MaintenanceContractResource extends Resource
{
    protected static ?string $model = MaintenanceContract::class;

    protected static ?string $navigationLabel = 'Contrats de maintenance';

    protected static ?string $modelLabel = 'Contrat de maintenance';

    protected static ?string $pluralModelLabel = 'Contrats de maintenance';

    protected static ?int $navigationSort = 4;

    protected static string|UnitEnum|null $navigationGroup = 'Espace Client';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    public static function form(Schema $schema): Schema
    {
        return MaintenanceContractForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MaintenanceContractsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMaintenanceContracts::route('/'),
            'create' => CreateMaintenanceContract::route('/create'),
            'edit' => EditMaintenanceContract::route('/{record}/edit'),
        ];
    }
}
