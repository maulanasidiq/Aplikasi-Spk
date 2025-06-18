@extends('layouts.app')

@section('title', 'Penilaian Siswa')

@section('content')
<h2>Penilaian Siswa</h2>

<form action="{{ route('penilaian.store') }}" method="POST">
    @csrf
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Siswa</th>
                @foreach ($kriterias as $k)
                <th>{{ $k->nama }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($alternatifs as $alt)
            <tr>
                <td>{{ $alt->nama }}</td>
                @foreach ($kriterias as $k)
                <td>
                    <input type="number" step="0.01" name="nilai[{{ $alt->id }}][{{ $k->id }}]"
                        value="{{ old("nilai.$alt->id.$k->id", $penilaian[$alt->id][$k->id] ?? '') }}" class="form-control">
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

    <button class="btn btn-success" type="submit">Simpan Penilaian</button>
</form>

<hr>

<form action="{{ route('penilaian.hitung') }}" method="GET">
    <button class="btn btn-primary mt-3" type="submit">🔍 Lihat Hasil Perhitungan</button>
</form>
@endsection