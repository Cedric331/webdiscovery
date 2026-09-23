<?php

namespace App\Filament\Resources\Demos\Pages;

use App\Filament\Resources\Demos\DemoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDemo extends CreateRecord
{
    protected static string $resource = DemoResource::class;

    protected static ?string $formMaxWidth = '7xl';
}
