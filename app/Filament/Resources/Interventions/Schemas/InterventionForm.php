<?php

namespace App\Filament\Resources\Interventions\Schemas;

use App\Filament\Forms\Components\CustomerSelectField;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InterventionForm
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
                        DatePicker::make('date')
                            ->label('Date d\'intervention')
                            ->required()
                            ->displayFormat('d/m/Y'),
                        TextInput::make('technician')
                            ->label('Technicien')
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Description')
                            ->columnSpanFull()
                            ->rows(4),
                    ])
                    ->columns(2),

                Section::make('Rapport PDF')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('pdf')
                            ->label('Rapport d\'intervention (PDF)')
                            ->collection('pdf')
                            ->downloadable()
                            ->openable()
                            ->acceptedFileTypes(['application/pdf'])
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
