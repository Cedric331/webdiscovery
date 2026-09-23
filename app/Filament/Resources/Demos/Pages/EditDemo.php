<?php

namespace App\Filament\Resources\Demos\Pages;

use App\Filament\Resources\Demos\DemoResource;
use Filament\Resources\Pages\EditRecord;

class EditDemo extends EditRecord
{
    protected static string $resource = DemoResource::class;

    protected static ?string $formMaxWidth = '7xl';
}
