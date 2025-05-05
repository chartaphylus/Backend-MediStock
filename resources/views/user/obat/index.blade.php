@extends('user.layout')
@section('content')
<h4>Data Obat</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="GET" class="row g-2 mb-3">
    <div class="col-md-4">
        <select name="kategori" class="form-select">
            <option value="">-- Semua Kategori --</option>
            @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Cari obat..." value="{{ request('search') }}">
    </div>
    <div class="col-md-4">
        <button class="btn btn-success">Filter</button>
        <a href="{{ route('user.obat.export') }}" class="btn btn-outline-success">Export Excel</a>
    </div>
</form>

<table class="table table-bordered">
    <thead class="table-success">
        <tr>
            <th>Nama Obat</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Kadaluarsa</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($obats as $obat)
        <tr>
            <td>{{ $obat->nama_obat }}</td>
            <td>{{ $obat->kategori->nama_kategori }}</td>
            <td>{{ $obat->stock }}</td>
            <td>{{ $obat->tanggal_kadaluarsa }}</td>
            <td>
                <!-- Tombol Edit -->
                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editObatModal{{ $obat->id }}">
                    Edit
                </button>
            </td>
        </tr>

        <!-- Modal Edit -->
        <div class="modal fade" id="editObatModal{{ $obat->id }}" tabindex="-1" aria-labelledby="editObatModalLabel{{ $obat->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('user.obat.update', $obat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="editObatModalLabel{{ $obat->id }}">Edit Obat</h5>
                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Obat</label>
                                <input type="text" class="form-control" name="nama_obat" value="{{ $obat->nama_obat }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="kategori_id" class="form-select" required>
                                    @foreach($kategoris as $kat)
                                        <option value="{{ $kat->id }}" @if($obat->kategori_id == $kat->id) selected @endif>
                                            {{ $kat->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" class="form-control" name="stock" value="{{ $obat->stock }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Kadaluarsa</label>
                                <input type="date" class="form-control" name="tanggal_kadaluarsa" value="{{ $obat->tanggal_kadaluarsa }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" class="form-control" name="harga" value="{{ $obat->harga }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </tbody>
</table>

{{ $obats->links('pagination::bootstrap-5') }}
@endsection
