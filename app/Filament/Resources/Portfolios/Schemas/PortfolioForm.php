<?php

namespace App\Filament\Resources\Portfolios\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use App\Models\Portfolio;

class PortfolioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations de la création')
                    ->schema([
                        TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),
                        Toggle::make('is_published')
                            ->label('Publié')
                            ->default(false)
                            ->columnSpan(2),
                        Textarea::make('description')
                            ->label('Description')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        TextInput::make('url')
                            ->label('URL du projet')
                            ->url()
                            ->placeholder('https://example.com')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Image de la création')
                            ->collection(Portfolio::MEDIA_IMAGE)
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->columnSpanFull(),
                        TagsInput::make('tags')
                            ->label('Technologies utilisées')
                            ->placeholder('Ajouter une technologie')
                            ->separator(',')
                            ->columnSpanFull(),
                    ])
                    ->columns(4),
            ]);
    }
}

