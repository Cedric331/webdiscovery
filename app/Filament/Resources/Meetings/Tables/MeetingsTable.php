<?php

namespace App\Filament\Resources\Meetings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MeetingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer.name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('prospect.name')
                    ->label('Prospect')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Organisateur')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Début')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('Fin')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('location')
                    ->label('Lieu')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'physical' => 'Présentiel',
                        'remote' => 'À distance',
                        'hybrid' => 'Hybride',
                        default => $state,
                    })
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_completed')
                    ->label('Terminée')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Créée le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'physical' => 'Présentiel',
                        'remote' => 'À distance',
                        'hybrid' => 'Hybride',
                    ]),
                SelectFilter::make('is_completed')
                    ->label('Statut')
                    ->options([
                        1 => 'Terminée',
                        0 => 'À venir',
                    ]),
                SelectFilter::make('customer_id')
                    ->label('Client')
                    ->relationship('customer', 'name'),
                SelectFilter::make('user_id')
                    ->label('Organisateur')
                    ->relationship('user', 'name'),
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
