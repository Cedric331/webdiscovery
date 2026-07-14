<?php

namespace App\Filament\Forms\Components;

use App\Models\Customer;
use Filament\Forms\Components\Select;
use Illuminate\Support\Collection;

class CustomerSelectField
{
    public static function make(bool $required = true): Select
    {
        return Select::make('customer_id')
            ->label('Client')
            ->relationship('customer', 'name')
            ->searchable()
            ->preload()
            ->required($required)
            ->getSearchResultsUsing(function (string $search): array {
                return Customer::query()
                    ->where(fn ($q) => $q
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                    )
                    ->orderBy('name')
                    ->limit(50)
                    ->get()
                    ->mapWithKeys(fn (Customer $customer) => [
                        $customer->id => self::formatLabel($customer),
                    ])
                    ->all();
            })
            ->getOptionLabelFromRecordUsing(fn (Customer $record) => self::formatLabel($record));
    }

    private static function formatLabel(Customer $customer): string
    {
        $name = collect([$customer->first_name, $customer->name])
            ->filter()
            ->join(' ');

        if ($customer->email) {
            $name .= " — {$customer->email}";
        }

        return $name;
    }
}
