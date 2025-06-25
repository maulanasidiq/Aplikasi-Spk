<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;

class PerhitunganController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();

        $normalisasi = [];
        foreach ($kriterias as $kriteria) {
            $nilai_kriteria = Penilaian::where('kriteria_id', $kriteria->id)->pluck('nilai');
            $max = $nilai_kriteria->max();
            $min = $nilai_kriteria->min();

            foreach ($alternatifs as $alt) {
                $nilai = Penilaian::where('alternatif_id', $alt->id)
                    ->where('kriteria_id', $kriteria->id)
                    ->value('nilai') ?? 0;

                if ($kriteria->jenis === 'benefit') {
                    $normalisasi[$alt->id][$kriteria->id] = $max > 0 ? $nilai / $max : 0;
                } else {
                    $normalisasi[$alt->id][$kriteria->id] = $nilai > 0 ? $min / $nilai : 0;
                }
            }
        }

        $hasil = [];
        foreach ($alternatifs as $alt) {
            $total = 0;
            foreach ($kriterias as $kriteria) {
                $bobot = $kriteria->bobot;
                $nilai_norm = $normalisasi[$alt->id][$kriteria->id] ?? 0;
                $total += $bobot * $nilai_norm;
            }

            $hasil[] = [
                'alternatif' => $alt,
                'nilai_akhir' => round($total, 4),
            ];
        }

        // Urutkan berdasarkan nilai akhir tertinggi
        usort($hasil, fn($a, $b) => $b['nilai_akhir'] <=> $a['nilai_akhir']);

        return view('perhitungan.index', compact('hasil'));
    }
}
