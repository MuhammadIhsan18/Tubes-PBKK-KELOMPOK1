@extends('layouts.app')
@section('content')
<div class="crumb"><i class="bi bi-house"></i> Home / <a href="{{ route('alatlab.index') }}">Inventaris Alat</a> / <strong>Tambah</strong></div>

<div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-4">
    <div>
        <h1 class="page-title">Tambah Alat Inventaris Baru</h1>
        <div class="page-sub">Lengkapi formulir di bawah untuk mendaftarkan alat laboratorium.</div>
    </div>
    <a href="{{ route('alatlab.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar</a>
</div>

<form action="{{ route('alatlab.store') }}" method="POST">
    @csrf
    @include('alatlab._form')
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('alatlab.index') }}" class="btn btn-outline-secondary">Batal</a>
        <button type="submit" class="btn btn-teal"><i class="bi bi-check-lg me-1"></i> Simpan Data Alat</button>
    </div>
</form>
@endsection