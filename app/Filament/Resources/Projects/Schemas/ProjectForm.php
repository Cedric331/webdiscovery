<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations du projet')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom du projet')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Description')
                            ->columnSpanFull()
                            ->rows(4),
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'planning' => 'Planification',
                                'in_progress' => 'En cours',
                                'on_hold' => 'En attente',
                                'completed' => 'Terminé',
                                'cancelled' => 'Annulé',
                            ])
                            ->required()
                            ->default('planning'),
                    ])
                    ->columns(2),

                Section::make('Relations')
                    ->schema([
                        Select::make('customer_id')
                            ->label('Client')
                            ->relationship('customer', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('user_id')
                            ->label('Responsable')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])
                    ->columns(2),

                Section::make('Dates et budget')
                    ->schema([
                        DatePicker::make('start_date')
                            ->label('Date de début'),
                        DatePicker::make('end_date')
                            ->label('Date de fin'),
                        TextInput::make('budget')
                            ->label('Budget')
                            ->numeric()
                            ->prefix('€')
                            ->step(0.01),
                        TextInput::make('billed_amount')
                            ->label('Montant facturé')
                            ->numeric()
                            ->prefix('€')
                            ->default(0.0)
                            ->required()
                            ->step(0.01),
                    ])
                    ->columns(2),

                Section::make('Documents')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('documents')
                            ->label('Documents du projet')
                            ->collection('documents')
                            ->multiple()
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }
}
