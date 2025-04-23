@extends('user.layout')
@section('content')
<h4>Dashboard</h4>

<canvas id="chartKategori" height="100"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartKategori');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($kategoriLabels->pluck('nama_kategori')) !!},
            datasets: [{
                label: 'Jumlah Obat per Kategori',
                data: {!! json_encode($kategoriLabels->pluck('obats_count')) !!},
                backgroundColor: 'rgba(75, 192, 75, 0.6)',
            }]
        }
    });
</script>

<div class="row mt-4">
    <div class="col-md-6">
        <h5>Stok Hampir Habis</h5>
        <ul class="list-group">
            @foreach ($stockHabis as $obat)
                <li class="list-group-item d-flex justify-content-between">
                    {{ $obat->nama_obat }} <span class="badge bg-danger">{{ $obat->stock }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="col-md-6">
        <h5>Kadaluarsa (7 hari ke depan)</h5>
        <ul class="list-group">
            @foreach ($kadaluarsa as $obat)
                <li class="list-group-item d-flex justify-content-between">
                    {{ $obat->nama_obat }} <span class="badge bg-warning">{{ $obat->tanggal_kadaluarsa }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
