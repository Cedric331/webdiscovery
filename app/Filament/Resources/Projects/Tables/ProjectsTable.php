<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer.name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Responsable')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'planning' => 'info',
                        'in_progress' => 'warning',
                        'on_hold' => 'gray',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'planning' => 'Planification',
                        'in_progress' => 'En cours',
                        'on_hold' => 'En attente',
                        'completed' => 'Terminé',
                        'cancelled' => 'Annulé',
                        default => $state,
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Date de début')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('Date de fin')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('budget')
                    ->label('Budget')
                    ->money('EUR', locale: 'fr')
                    ->sortable(),
                TextColumn::make('billed_amount')
                    ->label('Facturé')
                    ->money('EUR', locale: 'fr')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'planning' => 'Planification',
                        'in_progress' => 'En cours',
                        'on_hold' => 'En attente',
                        'completed' => 'Terminé',
                        'cancelled' => 'Annulé',
                    ]),
                SelectFilter::make('customer_id')
                    ->label('Client')
                    ->relationship('customer', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
