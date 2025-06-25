<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $alternatifs = Alternatif::all();
        $kriterias   = Kriteria::all();

        // Ambil semua penilaian lengkap dengan relasi
        $penilaian = Penilaian::with(['alternatif', 'kriteria'])->get();

        return view('penilaian.index', [
            'alternatifs' => $alternatifs,
            'kriterias'   => $kriterias,
            'penilaian'   => $penilaian
        ]);
    }

    public function create(Request $request)
    {
        return $this->index($request); // agar form tetap tampil seperti index
    }

    public function store(Request $request)
    {
        $alt_ids      = $request->input('alternatif_id', []);
        $kriteria_ids = $request->input('kriteria_id', []);
        $nilai_arr    = $request->input('nilai', []);

        // Validasi panjang array sama
        if (count($alt_ids) !== count($kriteria_ids) || count($alt_ids) !== count($nilai_arr)) {
            return redirect()->back()->with('error', 'Data tidak valid!');
        }

        for ($i = 0; $i < count($alt_ids); $i++) {
            Penilaian::updateOrCreate(
                [
                    'alternatif_id' => $alt_ids[$i],
                    'kriteria_id'   => $kriteria_ids[$i],
                ],
                [
                    'nilai' => $nilai_arr[$i],
                ]
            );
        }

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil disimpan.');
    }

    public function destroy($id)
    {
        Penilaian::destroy($id);
        return redirect()->route('penilaian.index')->with('success', 'Penilaian dihapus.');
    }

    public function hitung()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all();

        $matrix = [];
        foreach ($penilaians as $p) {
            $matrix[$p->alternatif_id][$p->kriteria_id] = $p->nilai;
        }

        $nilaiPerKriteria = [];
        foreach ($kriterias as $k) {
            $nilaiKriteria = Penilaian::where('kriteria_id', $k->id)->pluck('nilai');
            $nilaiPerKriteria[$k->id] = [
                'max' => $nilaiKriteria->max(),
                'min' => $nilaiKriteria->min(),
            ];
        }

        $hasil = [];
        foreach ($alternatifs as $alt) {
            $total = 0;
            foreach ($kriterias as $k) {
                $nilai = $matrix[$alt->id][$k->id] ?? 0;
                $normalisasi = 0;

                if ($k->jenis === 'benefit') {
                    $normalisasi = $nilai / max($nilaiPerKriteria[$k->id]['max'], 1);
                } elseif ($k->jenis === 'cost') {
                    $normalisasi = min($nilaiPerKriteria[$k->id]['min'], 1) / max($nilai, 1);
                }

                $total += $normalisasi * $k->bobot;
            }

            $hasil[] = [
                'alternatif' => $alt,
                'nilai_akhir' => round($total, 4),
            ];
        }

        return view('perhitungan.index', compact('hasil'));
    }

    public function edit($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();

        return view('penilaian.edit', compact('penilaian', 'alternatifs', 'kriterias'));
    }

    public function update(Request $request, $id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->update([
            'alternatif_id' => $request->alternatif_id,
            'kriteria_id'   => $request->kriteria_id,
            'nilai'         => $request->nilai,
        ]);

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui.');
    }
}
