@extends('layouts.app')
@section('content')
<h1>Edit Alat Lab</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('alatlab.update', $alatLab->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Nama Alat</label>
        <input type="text" name="nama_alat" class="form-control @error('nama_alat') is-invalid @enderror" value="{{ old('nama_alat', $alatLab->nama_alat) }}">
        @error('nama_alat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <input type="text" name="kategori" list="daftar-kategori" autocomplete="off"
               class="form-control @error('kategori') is-invalid @enderror" value="{{ old('kategori', $alatLab->kategori) }}">
        <datalist id="daftar-kategori">
            @foreach ($daftarKategori as $kat)
                <option value="{{ $kat }}">
            @endforeach
        </datalist>
        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Jumlah</label>
        <input type="number" min="0" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah', $alatLab->jumlah) }}">
        @error('jumlah') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Kondisi</label>
        <select name="kondisi" class="form-select @error('kondisi') is-invalid @enderror">
            <option value="">-- Pilih Kondisi --</option>
            <option value="Baik" {{ old('kondisi', $alatLab->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Rusak Ringan" {{ old('kondisi', $alatLab->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
            <option value="Rusak Berat" {{ old('kondisi', $alatLab->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
        </select>
        @error('kondisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Lokasi</label>
        <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $alatLab->lokasi) }}">
        @error('lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <a href="{{ route('alatlab.index') }}" class="btn btn-secondary">Batal</a>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection