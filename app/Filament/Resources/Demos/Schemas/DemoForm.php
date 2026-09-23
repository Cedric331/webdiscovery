<?php

namespace App\Filament\Resources\Demos\Schemas;

use App\Http\Controllers\DemoController;
use App\Models\Demo;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DemoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations de la démo')
                    ->description('Les textes, bénéfices et FAQ de la page restent gérés dans le code. Seuls les éléments ci-dessous sont modifiables ici.')
                    ->schema([
                        Select::make('slug')
                            ->label('Page de démo')
                            ->options(fn () => collect(DemoController::registry())
                                ->mapWithKeys(fn (array $demo) => [$demo['slug'] => $demo['name'].' ('.$demo['slug'].')'])
                                ->all())
                            ->helperText('Doit correspondre à une page de démo existante dans le code.')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->columnSpan(2),
                        TextInput::make('name')
                            ->label("Nom de l'offre")
                            ->helperText('Affiché dans le bloc tarif de la page.')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),
                        TextInput::make('price')
                            ->label('Tarif (€ HT)')
                            ->helperText('Repris dans le hero, le bloc tarif et les données structurées.')
                            ->numeric()
                            ->minValue(0)
                            ->suffix('€ HT')
                            ->columnSpan(2),
                        TextInput::make('demo_url')
                            ->label('URL du site de démonstration')
                            ->url()
                            ->placeholder('https://coach.web-discovery.fr')
                            ->maxLength(255)
                            ->columnSpan(2),
                    ])
                    ->columns(4),

                Section::make("Captures d'écran")
                    ->description("Si aucune capture n'est déposée, la page affiche un cadre d'attente : jamais d'image cassée.")
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('screenshot_desktop')
                            ->label('Aperçu desktop')
                            ->helperText('Format conseillé : ratio 16/10.')
                            ->collection(Demo::MEDIA_SCREENSHOT_DESKTOP)
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '16:10',
                                '16:9',
                            ])
                            ->columnSpan(2),
                        SpatieMediaLibraryFileUpload::make('screenshot_mobile')
                            ->label('Aperçu mobile')
                            ->helperText('Format conseillé : ratio 9/16.')
                            ->collection(Demo::MEDIA_SCREENSHOT_MOBILE)
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '9:16',
                            ])
                            ->columnSpan(2),
                    ])
                    ->columns(4),
            ]);
    }
}
