<?php

namespace App\Filament\Resources\Demos\Tables;

use App\Models\Demo;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DemosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('screenshot_desktop')
                    ->label('Aperçu')
                    ->collection(Demo::MEDIA_SCREENSHOT_DESKTOP),
                TextColumn::make('name')
                    ->label("Nom de l'offre")
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('Page')
                    ->badge()
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Tarif')
                    ->suffix(' € HT')
                    ->placeholder('Valeur du code')
                    ->sortable(),
                TextColumn::make('demo_url')
                    ->label('Démo en ligne')
                    ->url(fn (Demo $record) => $record->demo_url, shouldOpenInNewTab: true)
                    ->placeholder('—')
                    ->limit(40),
                TextColumn::make('updated_at')
                    ->label('Modifié le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name');
    }
}
