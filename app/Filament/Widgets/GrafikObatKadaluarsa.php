<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\Obat;
use Carbon\Carbon;

class GrafikObatKadaluarsa extends BarChartWidget
{
    protected static ?string $heading = 'Obat Kadaluarsa';

    protected function getData(): array
    {
        $now = now();
        $range = now()->addDays(14);

        // Obat yang hampir kadaluarsa (dalam 14 hari ke depan)
        $hampirKadaluarsa = Obat::whereBetween('tanggal_kadaluarsa', [$now, $range])
            ->orderBy('tanggal_kadaluarsa')
            ->get();

        // Obat yang sudah kadaluarsa
        $sudahKadaluarsa = Obat::whereDate('tanggal_kadaluarsa', '<', $now)
            ->orderBy('tanggal_kadaluarsa')
            ->get();

        // Gabungkan label dari kedua kelompok (Nama Obat + Tanggal)
        $labels = $hampirKadaluarsa->merge($sudahKadaluarsa)
            ->map(fn($obat) => $obat->nama_obat . ' (' . Carbon::parse($obat->tanggal_kadaluarsa)->format('d-m-Y') . ')')
            ->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Hampir Kadaluarsa',
                    'data' => collect($labels)->map(fn ($label) =>
                        $hampirKadaluarsa->filter(fn($obat) =>
                            $label === $obat->nama_obat . ' (' . Carbon::parse($obat->tanggal_kadaluarsa)->format('d-m-Y') . ')'
                        )->isNotEmpty() ? 1 : 0)->toArray(),
                    'backgroundColor' => 'rgba(255, 206, 86, 0.7)', // kuning
                ],
                [
                    'label' => 'Sudah Kadaluarsa',
                    'data' => collect($labels)->map(fn ($label) =>
                        $sudahKadaluarsa->filter(fn($obat) =>
                            $label === $obat->nama_obat . ' (' . Carbon::parse($obat->tanggal_kadaluarsa)->format('d-m-Y') . ')'
                        )->isNotEmpty() ? 1 : 0)->toArray(),
                    'backgroundColor' => 'rgba(255, 99, 132, 0.7)', // merah
                ],
            ],
        ];
    }
}
