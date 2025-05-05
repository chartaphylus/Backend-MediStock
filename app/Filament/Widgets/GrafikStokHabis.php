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
                    'backgroundColor' => $obats->map(function ($obat) {
                        return $obat->stock == 0
                            ? 'rgba(255, 99, 132, 0.8)'  
                            : 'rgba(255, 206, 86, 0.8)';
                    })->toArray(),
                ],
            ],
        ];
    }
}
