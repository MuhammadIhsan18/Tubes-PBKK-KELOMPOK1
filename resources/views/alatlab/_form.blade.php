@php
    $a = $alatLab ?? null;
    $opsiKondisi = [
        'Baik'         => ['bi-check-circle-fill',        '#15803d', 'Siap digunakan'],
        'Rusak Ringan' => ['bi-exclamation-triangle-fill','#b45309', 'Perlu perbaikan kecil'],
        'Rusak Berat'  => ['bi-x-octagon-fill',           '#b91c1c', 'Tidak dapat dipakai'],
    ];
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <strong><i class="bi bi-exclamation-octagon-fill me-1"></i> Terdapat {{ $errors->count() }} kesalahan pada formulir:</strong>
        <ul class="mb-0 mt-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card-lab mb-3">
    <div class="section-head">
        <span class="section-no">1</span>
        <div><strong>Informasi Dasar</strong><div class="page-sub small">Identitas alat laboratorium</div></div>
    </div>
    <div class="p-4 row g-3">
        <div class="col-md-6">
            <label class="form-label">Nama Alat <span class="text-danger">*</span></label>
            <input type="text" name="nama_alat" class="form-control @error('nama_alat') is-invalid @enderror"
                   placeholder="contoh: PC Desktop Core i5" value="{{ old('nama_alat', $a->nama_alat ?? '') }}">
            @error('nama_alat') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Kategori <span class="text-danger">*</span></label>
            <input type="text" name="kategori" list="daftar-kategori" autocomplete="off"
                   class="form-control @error('kategori') is-invalid @enderror"
                   placeholder="contoh: Komputer, Jaringan" value="{{ old('kategori', $a->kategori ?? '') }}">
            <datalist id="daftar-kategori">
                @foreach ($daftarKategori as $kat)
                    <option value="{{ $kat }}">
                @endforeach
            </datalist>
            @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<div class="card-lab mb-3">
    <div class="section-head">
        <span class="section-no">2</span>
        <div><strong>Stok, Lokasi &amp; Kondisi</strong><div class="page-sub small">Jumlah unit, penempatan, dan status alat</div></div>
    </div>
    <div class="p-4 row g-3">
        <div class="col-md-4">
            <label class="form-label">Jumlah Unit <span class="text-danger">*</span></label>
            <input type="number" min="0" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                   value="{{ old('jumlah', $a->jumlah ?? '') }}">
            @error('jumlah') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-8">
            <label class="form-label">Lokasi <span class="text-danger">*</span></label>
            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                   placeholder="contoh: Lab Komputer 1" value="{{ old('lokasi', $a->lokasi ?? '') }}">
            @error('lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-12">
            <label class="form-label">Status Kondisi <span class="text-danger">*</span></label>
            <div class="row g-3">
                @foreach ($opsiKondisi as $nilai => [$ikon, $warna, $ket])
                    <div class="col-md-4">
                        <label class="kondisi-option">
                            <input type="radio" name="kondisi" value="{{ $nilai }}"
                                   {{ old('kondisi', $a->kondisi ?? '') === $nilai ? 'checked' : '' }}>
                            <span class="kondisi-card">
                                <i class="bi {{ $ikon }}" style="color:{{ $warna }}"></i>
                                <span><strong>{{ $nilai }}</strong><br><small class="text-muted">{{ $ket }}</small></span>
                            </span>
                        </label>
                    </div>
                @endforeach
            </div>
            @error('kondisi') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
        </div>
    </div>
</div>