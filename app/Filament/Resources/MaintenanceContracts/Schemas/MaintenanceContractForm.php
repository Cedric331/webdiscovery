<?php

namespace App\Filament\Resources\MaintenanceContracts\Schemas;

use App\Filament\Forms\Components\CustomerSelectField;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MaintenanceContractForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations')
                    ->schema([
                        CustomerSelectField::make(),
                        TextInput::make('title')
                            ->label('Titre du contrat')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label('Description des prestations')
                            ->columnSpanFull()
                            ->rows(4),
                    ])
                    ->columns(2),

                Section::make('Tarification')
                    ->schema([
                        TextInput::make('monthly_price')
                            ->label('Tarif mensuel (€)')
                            ->numeric()
                            ->step(0.01),
                        TextInput::make('annual_price')
                            ->label('Tarif annuel (€)')
                            ->numeric()
                            ->step(0.01),
                    ])
                    ->columns(2),

                Section::make('Durée & Statut')
                    ->schema([
                        DatePicker::make('start_date')
                            ->label('Date de début')
                            ->required()
                            ->displayFormat('d/m/Y'),
                        DatePicker::make('end_date')
                            ->label('Date de fin')
                            ->displayFormat('d/m/Y'),
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'actif' => 'Actif',
                                'expire' => 'Expiré',
                                'suspendu' => 'Suspendu',
                            ])
                            ->default('actif')
                            ->required(),
                    ])
                    ->columns(3),

                Section::make('Contrat PDF')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('pdf')
                            ->label('Contrat signé (PDF)')
                            ->collection('pdf')
                            ->downloadable()
                            ->openable()
                            ->acceptedFileTypes(['application/pdf'])
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
