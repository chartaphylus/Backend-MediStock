<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Obat;
use App\Models\User;
use App\Models\Kategori;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Obat', Obat::count()),
            Card::make('Total User', User::count()),
            Card::make('Total Kategori', Kategori::count()),
        ];
    }
}
