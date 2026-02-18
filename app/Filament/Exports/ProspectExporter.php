<?php

namespace App\Filament\Exports;

use App\Models\Prospect;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ProspectExporter extends Exporter
{
    protected static ?string $model = Prospect::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('email')
                ->label('Email'),
            ExportColumn::make('company_name')
                ->label('Nom de la société'),
            ExportColumn::make('name')
                ->label('Nom'),
            ExportColumn::make('first_name')
                ->label('Prénom'),
            ExportColumn::make('phone')
                ->label('Téléphone'),
            ExportColumn::make('source')
                ->label('Source')
                ->formatStateUsing(fn (?string $state): string => match ($state) {
                    'concours' => 'Concours',
                    'contact' => 'Contact',
                    null => 'Non spécifié',
                    default => $state ?? '',
                }),
            ExportColumn::make('status')
                ->label('Statut')
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'new' => 'Nouveau',
                    'in_progress' => 'En cours',
                    'qualified' => 'Qualifié',
                    'converted' => 'Converti',
                    'lost' => 'Perdu',
                    default => $state,
                }),
            ExportColumn::make('prospect_date')
                ->label('Date de prospection')
                ->formatStateUsing(fn ($state) => $state ? $state->format('d/m/Y') : ''),
            ExportColumn::make('created_at')
                ->label('Date de création')
                ->formatStateUsing(fn ($state) => $state ? $state->format('d/m/Y H:i') : ''),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'L\'export de ' . number_format($export->successful_rows) . ' prospect(s) a été complété avec succès.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ligne(s) ont échoué.';
        }

        return $body;
    }
}

