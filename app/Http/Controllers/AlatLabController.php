<?php

namespace App\Http\Controllers;

use App\Models\AlatLab;
use Illuminate\Http\Request;

class AlatLabController extends Controller
{
    public function index()
    {
        $alatLabs = AlatLab::all();
        return view('alatlab.index', compact('alatLabs'));
    }

    public function create()
    {
        return view('alatlab.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama_alat' => 'required|string|max:255',
        'kategori'  => 'required|string|max:255',
        'jumlah'    => 'required|integer|min:0',
        'kondisi'   => 'required|string',
        'lokasi'    => 'required|string|max:255',
    ]);

    AlatLab::create($validated);

    return redirect()->route('alatlab.index')
        ->with('success', 'Alat lab berhasil ditambahkan!');
}

   public function edit(AlatLab $alatLab)
    {
        return view('alatlab.edit', compact('alatLab'));
    }
    public function update(Request $request, AlatLab $alatLab)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori'  => 'required|string|max:255',
            'jumlah'    => 'required|integer|min:0',
            'kondisi'   => 'required|string',
            'lokasi'    => 'required|string|max:255',
        ]);
        $alatLab->update($request->all());
        return redirect()->route('alatlab.index')
            ->with('success', 'Alat lab berhasil diperbarui!');
    }
    public function destroy(AlatLab $alatLab)
    {
        $alatLab->delete();
        return redirect()->route('alatlab.index')
            ->with('success', 'Alat lab berhasil dihapus!');
    }

}