<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations principales')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom')
                            ->required()
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

                Section::make('Informations complémentaires')
                    ->schema([
                        Textarea::make('additional_info')
                            ->label('Informations supplémentaires')
                            ->columnSpanFull()
                            ->rows(4),
                    ]),

                Section::make('Accès Espace Client')
                    ->schema([
                        Toggle::make('portal_enabled')
                            ->label('Activer l\'accès au portail client')
                            ->helperText('Le client pourra se connecter sur /espace-client avec son email.')
                            ->columnSpanFull(),
                        TextInput::make('password')
                            ->label('Mot de passe')
                            ->password()
                            ->revealable()
                            ->helperText('Laissez vide pour ne pas modifier le mot de passe existant.')
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Documents')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('invoices')
                            ->label('Factures')
                            ->collection('invoices')
                            ->multiple()
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('quotes')
                            ->label('Devis')
                            ->collection('quotes')
                            ->multiple()
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('specifications')
                            ->label('Cahiers des charges')
                            ->collection('specifications')
                            ->multiple()
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('documents')
                            ->label('Autres documents')
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
