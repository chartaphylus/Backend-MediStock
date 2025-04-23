<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\Obat;

class GrafikStokHabis extends BarChartWidget
{
    protected static ?string $heading = 'Obat dengan Stok Habis / Rendah';

    protected function getData(): array
    {
        $obats = Obat::where('stock', '<=', 10)
            ->orderBy('stock', 'asc')
            ->take(10)
            ->get();

        return [
            'labels' => $obats->pluck('nama_obat')->toArray(),
            'datasets' => [
                [
                    'label' => 'Stok Tersisa',
                    'data' => $obats->pluck('stock')->toArray(),
                ],
            ],
        ];
    }
}
