@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Daftar Alat Lab</h1>
        <a href="{{ route('alatlab.create') }}" class="btn btn-primary">+ Tambah Alat</a>
    </div>

    <table class="table table-bordered table-striped">
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
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $alat->nama_alat }}</td>
                    <td>{{ $alat->kategori }}</td>
                    <td>{{ $alat->jumlah }}</td>
                    <td>{{ $alat->kondisi }}</td>
                    <td>{{ $alat->lokasi }}</td>
                    <td>
                        <a href="{{ route('alatlab.edit', $alat) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('alatlab.destroy', $alat) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data alat lab.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection