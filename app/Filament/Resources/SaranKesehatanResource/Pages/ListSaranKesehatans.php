<?php

namespace App\Filament\Resources\SaranKesehatanResource\Pages;

use App\Filament\Resources\SaranKesehatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSaranKesehatans extends ListRecords
{
    protected static string $resource = SaranKesehatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
