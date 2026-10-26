<?php

namespace App\Http\Controllers;

use App\Models\AlatLab;
use Illuminate\Http\Request;

class AlatLabController extends Controller
{
    private const KONDISI = ['Baik', 'Rusak Ringan', 'Rusak Berat'];

    public function index(Request $request)
    {
        $query = AlatLab::query();

        // Bonus 1: pencarian (nama alat, kategori, lokasi)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_alat', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Bonus 2: filter berdasarkan kondisi
        if ($request->filled('kondisi') && in_array($request->kondisi, self::KONDISI, true)) {
            $query->where('kondisi', $request->kondisi);
        }

        // Bonus 3: pagination (10 data per halaman, pencarian ikut terbawa)
        $alatLabs = $query->latest()->paginate(10)->withQueryString();

        // Bonus 4: statistik ringkasan (dihitung dari semua data)
        $totalJenis         = AlatLab::count();
        $totalUnit          = (int) AlatLab::sum('jumlah');
        $kondisiBaik        = AlatLab::where('kondisi', 'Baik')->count();
        $kondisiRusakRingan = AlatLab::where('kondisi', 'Rusak Ringan')->count();
        $kondisiRusakBerat  = AlatLab::where('kondisi', 'Rusak Berat')->count();

        return view('alatlab.index', compact(
            'alatLabs',
            'totalJenis',
            'totalUnit',
            'kondisiBaik',
            'kondisiRusakRingan',
            'kondisiRusakBerat'
        ));
    }

    public function create()
    {
        return view('alatlab.create', [
            'daftarKategori' => $this->daftarKategori(),
        ]);
    }

    public function store(Request $request)
    {
        AlatLab::create($this->validateData($request));

        return redirect()->route('alatlab.index')
            ->with('success', 'Alat lab berhasil ditambahkan!');
    }

    public function edit(AlatLab $alatLab)
    {
        return view('alatlab.edit', [
            'alatLab'        => $alatLab,
            'daftarKategori' => $this->daftarKategori(),
        ]);
    }

    public function update(Request $request, AlatLab $alatLab)
    {
        $alatLab->update($this->validateData($request));

        return redirect()->route('alatlab.index')
            ->with('success', 'Alat lab berhasil diperbarui!');
    }

    public function destroy(AlatLab $alatLab)
    {
        $alatLab->delete();

        return redirect()->route('alatlab.index')
            ->with('success', 'Alat lab berhasil dihapus!');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori'  => 'required|string|max:255',
            'jumlah'    => 'required|integer|min:0',
            'kondisi'   => 'required|in:' . implode(',', self::KONDISI),
            'lokasi'    => 'required|string|max:255',
        ]);
    }

    // Bonus 5: saran kategori yang sudah pernah dipakai (untuk autocomplete di form)
    private function daftarKategori()
    {
        return AlatLab::query()
            ->select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');
    }
}