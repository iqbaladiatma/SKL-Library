<?php

namespace App\Filament\Resources\BookPurchaseResource\Pages;

use App\Filament\Resources\BookPurchaseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBookPurchase extends CreateRecord
{
    protected static string $resource = BookPurchaseResource::class;
}
