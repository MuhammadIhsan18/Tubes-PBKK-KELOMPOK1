<?php

namespace Database\Seeders;

use App\Models\AlatLab;
use Illuminate\Database\Seeder;

class AlatLabSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['PC Desktop Core i5',     'Komputer',      30, 'Baik',         'Lab Komputer 1'],
            ['Monitor LED 24 inci',    'Perangkat Output', 30, 'Baik',      'Lab Komputer 1'],
            ['Keyboard USB',           'Perangkat Input', 35, 'Rusak Ringan', 'Lab Komputer 1'],
            ['Mouse Optik',            'Perangkat Input', 35, 'Baik',        'Lab Komputer 2'],
            ['Router Wi-Fi TP-Link',   'Jaringan',       4, 'Baik',         'Lab Jaringan'],
            ['Switch 24 Port',         'Jaringan',       3, 'Baik',         'Lab Jaringan'],
            ['Proyektor Epson',        'Multimedia',     2, 'Rusak Ringan', 'Lab Komputer 2'],
            ['UPS 1200 VA',            'Kelistrikan',    6, 'Rusak Berat',  'Ruang Server'],
            ['Kabel LAN UTP Cat6',     'Jaringan',      50, 'Baik',         'Lab Jaringan'],
            ['Printer Laser HP',       'Perangkat Output', 2, 'Rusak Berat', 'Lab Komputer 2'],
        ];

        foreach ($data as [$nama, $kategori, $jumlah, $kondisi, $lokasi]) {
            AlatLab::create([
                'nama_alat' => $nama,
                'kategori'  => $kategori,
                'jumlah'    => $jumlah,
                'kondisi'   => $kondisi,
                'lokasi'    => $lokasi,
            ]);
        }
    }
}