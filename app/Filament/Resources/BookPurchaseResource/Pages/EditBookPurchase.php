<?php

namespace App\Filament\Resources\BookPurchaseResource\Pages;

use App\Filament\Resources\BookPurchaseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookPurchase extends EditRecord
{
    protected static string $resource = BookPurchaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
