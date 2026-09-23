<?php

namespace App\Filament\Resources\Demos\Pages;

use App\Filament\Resources\Demos\DemoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDemos extends ListRecords
{
    protected static string $resource = DemoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
