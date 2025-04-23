<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\Obat;
use Carbon\Carbon;

class GrafikObatKadaluarsa extends BarChartWidget
{
    protected static ?string $heading = 'Obat Hampir Kadaluarsa';

    protected function getData(): array
    {
        $range = now()->addDays(14); // 14 hari ke depan
        $obats = Obat::whereDate('tanggal_kadaluarsa', '<=', $range)
            ->orderBy('tanggal_kadaluarsa')
            ->get();

        return [
            'labels' => $obats->pluck('nama_obat')->toArray(),
            'datasets' => [
                [
                    'label' => 'Tanggal Kadaluarsa',
                    'data' => $obats->pluck('tanggal_kadaluarsa')->map(fn($tgl) => Carbon::parse($tgl)->diffInDays(now()))->toArray(),
                ],
            ],
        ];
    }
}
