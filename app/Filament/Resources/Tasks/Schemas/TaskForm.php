<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations de la tâche')
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
                            ->nullable(),
                        Select::make('project_id')
                            ->label('Projet')
                            ->relationship('project', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('user_id')
                            ->label('Assigné à')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])
                    ->columns(3),

                Section::make('Statut et priorité')
                    ->schema([
                        Select::make('priority')
                            ->label('Priorité')
                            ->options([
                                'low' => 'Basse',
                                'medium' => 'Moyenne',
                                'high' => 'Haute',
                                'urgent' => 'Urgente',
                            ])
                            ->required()
                            ->default('medium'),
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'todo' => 'À faire',
                                'in_progress' => 'En cours',
                                'review' => 'En révision',
                                'completed' => 'Terminée',
                                'cancelled' => 'Annulée',
                            ])
                            ->required()
                            ->default('todo'),
                    ])
                    ->columns(2),

                Section::make('Dates')
                    ->schema([
                        DatePicker::make('due_date')
                            ->label('Date d\'échéance'),
                        DateTimePicker::make('completed_at')
                            ->label('Date de complétion'),
                    ])
                    ->columns(2),
            ]);
    }
}
