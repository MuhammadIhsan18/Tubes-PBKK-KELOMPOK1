@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Daftar Alat Lab</h1>
    <a href="{{ route('alatlab.create') }}" class="btn btn-primary">+ Tambah Alat</a>
</div>

{{-- Statistik ringkasan --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md">
        <div class="card text-center h-100">
            <div class="card-body">
                <div class="fs-3 fw-bold">{{ $totalJenis }}</div>
                <div class="text-muted small">Jenis Alat</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md">
        <div class="card text-center h-100">
            <div class="card-body">
                <div class="fs-3 fw-bold">{{ $totalUnit }}</div>
                <div class="text-muted small">Total Unit</div>
            </div>
        </div>
    </div>
    <div class="col-4 col-md">
        <div class="card text-center h-100 border-success">
            <div class="card-body">
                <div class="fs-3 fw-bold text-success">{{ $kondisiBaik }}</div>
                <div class="text-muted small">Baik</div>
            </div>
        </div>
    </div>
    <div class="col-4 col-md">
        <div class="card text-center h-100 border-warning">
            <div class="card-body">
                <div class="fs-3 fw-bold text-warning">{{ $kondisiRusakRingan }}</div>
                <div class="text-muted small">Rusak Ringan</div>
            </div>
        </div>
    </div>
    <div class="col-4 col-md">
        <div class="card text-center h-100 border-danger">
            <div class="card-body">
                <div class="fs-3 fw-bold text-danger">{{ $kondisiRusakBerat }}</div>
                <div class="text-muted small">Rusak Berat</div>
            </div>
        </div>
    </div>
</div>

{{-- Pencarian dan filter --}}
<form action="{{ route('alatlab.index') }}" method="GET" class="row g-2 mb-3">
    <div class="col-md-6">
        <input type="text" name="search" class="form-control"
               placeholder="Cari nama alat, kategori, atau lokasi..."
               value="{{ request('search') }}">
    </div>
    <div class="col-md-3">
        <select name="kondisi" class="form-select">
            <option value="">Semua Kondisi</option>
            @foreach (['Baik', 'Rusak Ringan', 'Rusak Berat'] as $k)
                <option value="{{ $k }}" {{ request('kondisi') === $k ? 'selected' : '' }}>{{ $k }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3 d-flex gap-2">
        <button type="submit" class="btn btn-dark flex-fill">Cari</button>
        @if (request()->filled('search') || request()->filled('kondisi'))
            <a href="{{ route('alatlab.index') }}" class="btn btn-outline-secondary">Reset</a>
        @endif
    </div>
</form>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alatLabs as $alat)
                @php
                    $badge = match ($alat->kondisi) {
                        'Baik'         => 'success',
                        'Rusak Ringan' => 'warning text-dark',
                        'Rusak Berat'  => 'danger',
                        default        => 'secondary',
                    };
                @endphp
                <tr>
                    <td>{{ $alatLabs->firstItem() + $loop->index }}</td>
                    <td>{{ $alat->nama_alat }}</td>
                    <td>{{ $alat->kategori }}</td>
                    <td>{{ $alat->jumlah }}</td>
                    <td><span class="badge bg-{{ $badge }}">{{ $alat->kondisi }}</span></td>
                    <td>{{ $alat->lokasi }}</td>
                    <td>
                        <a href="{{ route('alatlab.edit', $alat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('alatlab.destroy', $alat->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus {{ $alat->nama_alat }}?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        @if (request()->filled('search') || request()->filled('kondisi'))
                            Tidak ada alat yang cocok dengan pencarian.
                        @else
                            Belum ada data alat lab.
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-between align-items-center">
    <small class="text-muted">
        @if ($alatLabs->total() > 0)
            Menampilkan {{ $alatLabs->firstItem() }}–{{ $alatLabs->lastItem() }} dari {{ $alatLabs->total() }} data
        @endif
    </small>
    {{ $alatLabs->links('pagination::bootstrap-5') }}
</div>
@endsection