<?php

namespace App\Filament\Resources\Prospects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProspectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations principales')
                    ->schema([
                        Select::make('customer_id')
                            ->label('Client associé')
                            ->relationship('customer', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        TextInput::make('name')
                            ->label('Nom')
                            ->maxLength(255),
                        TextInput::make('first_name')
                            ->label('Prénom')
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('Téléphone')
                            ->tel()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Entreprise')
                    ->schema([
                        TextInput::make('company_name')
                            ->label('Nom de l\'entreprise')
                            ->maxLength(255),
                        TextInput::make('website')
                            ->label('Site web')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('activity')
                            ->label('Activité')
                            ->maxLength(255),
                        Textarea::make('address')
                            ->label('Adresse')
                            ->columnSpanFull()
                            ->rows(3),
                    ])
                    ->columns(2),

                Section::make('Statut et suivi')
                    ->schema([
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'new' => 'Nouveau',
                                'in_progress' => 'En cours',
                                'qualified' => 'Qualifié',
                                'converted' => 'Converti',
                                'lost' => 'Perdu',
                            ])
                            ->required()
                            ->default('in_progress'),
                        Select::make('source')
                            ->label('Source')
                            ->options([
                                'concours' => 'Concours',
                                'contact' => 'Contact',
                            ])
                            ->nullable(),
                        DatePicker::make('prospect_date')
                            ->label('Date de prospection'),
                    ])
                    ->columns(2),

                Section::make('Notes')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Notes')
                            ->columnSpanFull()
                            ->rows(4),
                    ])
                    ->collapsible(),
            ]);
    }
}
