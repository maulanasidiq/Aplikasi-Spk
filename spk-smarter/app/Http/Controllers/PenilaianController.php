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
        // Jika tidak ada input, ambil semua data
        $selectedAlternatifIds = $request->has('alternatif_id')
            ? $request->input('alternatif_id', [])
            : Alternatif::pluck('id')->toArray();

        $selectedKriteriaIds = $request->has('kriteria_id')
            ? $request->input('kriteria_id', [])
            : Kriteria::pluck('id')->toArray();

        // Ambil data sesuai ID yang dipilih atau semuanya
        $alternatifs = Alternatif::whereIn('id', $selectedAlternatifIds)->get();
        $kriterias   = Kriteria::whereIn('id', $selectedKriteriaIds)->get();

        // Ambil semua penilaian
        $penilaian = [];
        foreach (Penilaian::all() as $p) {
            $penilaian[$p->alternatif_id][$p->kriteria_id] = $p->nilai;
        }

        return view('penilaian.index', [
            'allAlternatifs' => Alternatif::all(),
            'allKriterias'   => Kriteria::all(),
            'alternatifs'    => $alternatifs,
            'kriterias'      => $kriterias,
            'penilaian'      => $penilaian,
            'selectedAlternatifIds' => $selectedAlternatifIds,
            'selectedKriteriaIds'   => $selectedKriteriaIds
        ]);
    }

    public function create(Request $request)
    {
        return $this->index($request);
    }

    public function store(Request $request)
    {
        $dataAll = $request->input('nilai', []);

        foreach ($dataAll as $alt_id => $kriteria_nilai) {
            foreach ($kriteria_nilai as $krit_id => $nilai) {
                Penilaian::updateOrCreate(
                    [
                        'alternatif_id' => $alt_id,
                        'kriteria_id'   => $krit_id,
                    ],
                    ['nilai'         => $nilai]
                );
            }
        }

        // Ambil ID alternatif dan kriteria dari data yang disimpan
        $selectedAlternatifIds = array_keys($dataAll);
        $selectedKriteriaIds = [];

        foreach ($dataAll as $krits) {
            $selectedKriteriaIds = array_merge($selectedKriteriaIds, array_keys($krits));
        }

        // Hilangkan duplikat
        $selectedKriteriaIds = array_unique($selectedKriteriaIds);

        // Panggil ulang fungsi index dan kirim data terpilih
        return $this->index(new Request([
            'alternatif_id' => $selectedAlternatifIds,
            'kriteria_id' => $selectedKriteriaIds,
        ]));
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
}
