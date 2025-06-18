<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index()
    {
        return view('perhitungan');
    }

    public function proses(Request $request)
    {
        // Validasi input
        $request->validate([
            'alternatif' => 'required|string',
            'nilai_akademik' => 'required|numeric|min:0|max:100',
            'disiplin' => 'required|numeric|min:0|max:100',
            'kehadiran' => 'required|numeric|min:0|max:100',
        ]);

        // Ambil nilai
        $data = [
            'alternatif' => $request->alternatif,
            'nilai_akademik' => $request->nilai_akademik,
            'disiplin' => $request->disiplin,
            'kehadiran' => $request->kehadiran,
        ];

        // Bobot preferensi (bisa dari database juga)
        $bobot = [
            'nilai_akademik' => 0.5,
            'disiplin' => 0.3,
            'kehadiran' => 0.2,
        ];

        // Normalisasi dan pembobotan (SMARTER)
        $total = 0;
        foreach ($bobot as $kriteria => $bobot_kriteria) {
            $total += $data[$kriteria] * $bobot_kriteria;
        }

        // Kirim ke view
        return view('perhitungan-hasil', [
            'data' => $data,
            'bobot' => $bobot,
            'hasil' => $total,
        ]);
    }
}
