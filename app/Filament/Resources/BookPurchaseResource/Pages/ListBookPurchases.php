<?php

namespace App\Filament\Resources\BookPurchaseResource\Pages;

use App\Filament\Resources\BookPurchaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookPurchases extends ListRecords
{
    protected static string $resource = BookPurchaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
