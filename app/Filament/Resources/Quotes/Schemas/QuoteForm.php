<?php

namespace App\Filament\Resources\Quotes\Schemas;

use App\Filament\Forms\Components\CustomerSelectField;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QuoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations')
                    ->schema([
                        CustomerSelectField::make(),
                        TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('number')
                            ->label('Numéro de devis')
                            ->maxLength(255),
                        DatePicker::make('date')
                            ->label('Date')
                            ->required()
                            ->displayFormat('d/m/Y'),
                        TextInput::make('amount')
                            ->label('Montant (€)')
                            ->numeric()
                            ->step(0.01),
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'en_attente' => 'En attente',
                                'accepte' => 'Accepté',
                                'refuse' => 'Refusé',
                                'expire' => 'Expiré',
                            ])
                            ->default('en_attente')
                            ->required(),
                        Textarea::make('description')
                            ->label('Description')
                            ->columnSpanFull()
                            ->rows(3),
                    ])
                    ->columns(2),

                Section::make('Document PDF')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('pdf')
                            ->label('Devis PDF')
                            ->collection('pdf')
                            ->downloadable()
                            ->openable()
                            ->acceptedFileTypes(['application/pdf'])
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
