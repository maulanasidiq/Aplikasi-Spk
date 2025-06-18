<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $penilaians = Penilaian::with('alternatif', 'kriteria')->get();
        return view('penilaian.index', compact('penilaians'));
    }

    public function create()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        return view('penilaian.create', compact('alternatifs', 'kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alternatif_id' => 'required|exists:alternatifs,id',
            'kriteria_id' => 'required|exists:kriterias,id',
            'nilai' => 'required|numeric',
        ]);

        Penilaian::create($request->all());

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil ditambahkan');
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
        $penilaian->update($request->all());

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui');
    }

    public function destroy($id)
    {
        Penilaian::destroy($id);
        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil dihapus');
    }
}
