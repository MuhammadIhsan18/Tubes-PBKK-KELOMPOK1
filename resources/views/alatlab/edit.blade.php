@extends('layouts.app')
@section('content')
<div class="crumb"><i class="bi bi-house"></i> Home / <a href="{{ route('alatlab.index') }}">Inventaris Alat</a> / <strong>Edit: {{ $alatLab->nama_alat }}</strong></div>

<div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
    <div>
        <h1 class="page-title">Edit Data Alat: {{ $alatLab->nama_alat }}</h1>
        <div class="page-sub">Perbarui informasi, jumlah, dan kondisi alat. Terakhir diubah {{ $alatLab->updated_at?->translatedFormat('d M Y, H:i') }}.</div>
    </div>
    <a href="{{ route('alatlab.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar</a>
</div>

<form action="{{ route('alatlab.update', $alatLab) }}" method="POST">
    @csrf
    @method('PUT')
    @include('alatlab._form')
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('alatlab.index') }}" class="btn btn-outline-secondary">Batal</a>
        <button type="submit" class="btn btn-teal"><i class="bi bi-check-lg me-1"></i> Perbarui Data Alat</button>
    </div>
</form>
@endsection