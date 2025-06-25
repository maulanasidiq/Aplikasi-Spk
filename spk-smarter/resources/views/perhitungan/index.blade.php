@extends('layouts.app')

@section('title', 'Hasil Perhitungan')

@section('content')
<h2>📊 Hasil Perhitungan Metode SMARTER</h2>

@if(count($hasil) > 0)
<table class="table table-bordered mt-4">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Nilai Akhir</th>
            <th>Peringkat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($hasil as $index => $row)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $row['alternatif']->nama }}</td>
            <td>{{ $row['alternatif']->kelas }}</td>
            <td>{{ $row['nilai_akhir'] }}</td>
            <td>{{ $index + 1 }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="alert alert-warning mt-4">
    Belum ada data penilaian yang dapat dihitung.
</div>
@endif

<a href="{{ route('penilaian.index') }}" class="btn btn-secondary mt-3">← Kembali ke Penilaian</a>
@endsection