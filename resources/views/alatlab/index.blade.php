@extends('layouts.app')
@section('content')
<div class="crumb"><i class="bi bi-house"></i> Home / <strong>Inventaris Alat</strong></div>

<div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
    <div>
        <h1 class="page-title">Inventaris Alat Laboratorium</h1>
        <div class="page-sub">Kelola data peralatan lab komputer, jumlah unit, dan kondisinya.</div>
    </div>
    <a href="{{ route('alatlab.create') }}" class="btn btn-teal"><i class="bi bi-plus-lg me-1"></i> Tambah Alat Baru</a>
</div>

{{-- Statistik --}}
@php
    $stats = [
        ['Jenis Alat',    $totalJenis,         'bi-collection',          '#e0f2fe', '#0369a1'],
        ['Total Unit',    $totalUnit,          'bi-hdd-stack',           '#e6f4f6', '#0f7c8c'],
        ['Kondisi Baik',  $kondisiBaik,        'bi-check-circle',        '#dcfce7', '#15803d'],
        ['Rusak Ringan',  $kondisiRusakRingan, 'bi-exclamation-triangle','#fef3c7', '#b45309'],
        ['Rusak Berat',   $kondisiRusakBerat,  'bi-x-octagon',           '#fee2e2', '#b91c1c'],
    ];
@endphp
<div class="row g-3 mb-4">
    @foreach ($stats as [$label, $nilai, $ikon, $bg, $warna])
        <div class="col-6 col-lg">
            <div class="card-lab stat">
                <div>
                    <div class="lbl">{{ $label }}</div>
                    <div class="num">{{ $nilai }}</div>
                </div>
                <div class="stat-icon" style="background:{{ $bg }};color:{{ $warna }}"><i class="bi {{ $ikon }}"></i></div>
            </div>
        </div>
    @endforeach
</div>

{{-- Pencarian dan filter --}}
<form action="{{ route('alatlab.index') }}" method="GET" class="card-lab p-3 mb-3">
    <div class="row g-2 align-items-end">
        <div class="col-lg-6">
            <label class="form-label mb-1">Pencarian Cepat</label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control" placeholder="Cari nama alat, kategori, atau lokasi..." value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-lg-3">
            <label class="form-label mb-1">Status Kondisi</label>
            <select name="kondisi" class="form-select">
                <option value="">Semua Kondisi</option>
                @foreach (['Baik', 'Rusak Ringan', 'Rusak Berat'] as $k)
                    <option value="{{ $k }}" {{ request('kondisi') === $k ? 'selected' : '' }}>{{ $k }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 d-flex gap-2">
            <button type="submit" class="btn btn-teal flex-fill"><i class="bi bi-funnel me-1"></i> Terapkan</button>
            @if (request()->filled('search') || request()->filled('kondisi'))
                <a href="{{ route('alatlab.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </div>
    </div>
</form>

{{-- Tabel --}}
<div class="card-lab overflow-hidden">
    <div class="table-responsive">
        <table class="table table-lab mb-0">
            <thead>
                <tr>
                    <th style="width:60px">No</th>
                    <th>Nama Alat</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Kondisi</th>
                    <th>Lokasi</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($alatLabs as $alat)
                    @php
                        $pill = match ($alat->kondisi) {
                            'Baik'         => 'pill-baik',
                            'Rusak Ringan' => 'pill-ringan',
                            'Rusak Berat'  => 'pill-berat',
                            default        => '',
                        };
                    @endphp
                    <tr>
                        <td class="text-muted">{{ $alatLabs->firstItem() + $loop->index }}</td>
                        <td class="fw-semibold">{{ $alat->nama_alat }}</td>
                        <td><span class="tag">{{ $alat->kategori }}</span></td>
                        <td><strong>{{ $alat->jumlah }}</strong> <span class="text-muted small">unit</span></td>
                        <td><span class="pill {{ $pill }}">{{ $alat->kondisi }}</span></td>
                        <td><i class="bi bi-geo-alt text-muted"></i> {{ $alat->lokasi }}</td>
                        <td class="text-end">
                            <a href="{{ route('alatlab.edit', $alat) }}" class="icon-btn" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('alatlab.destroy', $alat) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="icon-btn danger" title="Hapus"
                                        onclick="return confirm('Yakin hapus {{ $alat->nama_alat }}?')"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-3 d-block mb-1"></i>
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
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-3 border-top">
        <small class="text-muted">
            @if ($alatLabs->total() > 0)
                Menampilkan {{ $alatLabs->firstItem() }}–{{ $alatLabs->lastItem() }} dari {{ $alatLabs->total() }} alat
            @endif
        </small>
        {{ $alatLabs->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection