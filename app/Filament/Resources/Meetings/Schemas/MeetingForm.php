<?php

namespace App\Filament\Resources\Meetings\Schemas;

use App\Models\Customer;
use App\Models\Prospect;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MeetingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations de la réunion')
                    ->schema([
                        TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Description')
                            ->columnSpanFull()
                            ->rows(4),
                    ]),

                Section::make('Relations')
                    ->schema([
                        Select::make('customer_id')
                            ->label('Client')
                            ->relationship('customer', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->getOptionLabelFromRecordUsing(
                                fn (Customer $record): string => $record->name ?: 'Client sans nom'
                            ),

                        Select::make('prospect_id')
                            ->label('Prospect')
                            ->relationship('prospect', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->getOptionLabelFromRecordUsing(
                                fn (Prospect $record): string => $record->name ?: 'Prospect sans nom'
                            ),

                        Select::make('user_id')
                            ->label('Organisateur')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->getOptionLabelFromRecordUsing(
                                fn (User $record): string => $record->name ?: 'Utilisateur sans nom'
                            ),
                    ])
                    ->columns(1),

                Section::make('Date et lieu')
                    ->schema([
                        DateTimePicker::make('start_date')
                            ->label('Date et heure de début')
                            ->required(),
                        DateTimePicker::make('end_date')
                            ->label('Date et heure de fin'),
                        TextInput::make('location')
                            ->label('Lieu')
                            ->maxLength(255),
                        Select::make('type')
                            ->label('Type')
                            ->options([
                                'physical' => 'Présentiel',
                                'remote' => 'À distance',
                                'hybrid' => 'Hybride',
                            ])
                            ->required()
                            ->default('physical'),
                    ])
                    ->columns(2),

                Section::make('Statut et notes')
                    ->schema([
                        Toggle::make('is_completed')
                            ->label('Réunion terminée')
                            ->default(false),
                        Textarea::make('notes')
                            ->label('Notes')
                            ->columnSpanFull()
                            ->rows(4),
                    ])
                    ->columns(1),
            ]);
    }
}
