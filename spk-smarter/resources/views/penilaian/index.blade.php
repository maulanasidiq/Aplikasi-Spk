@extends('layouts.app')

@section('title', 'Input Penilaian')

@section('content')
<h2>Form Penilaian</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Form Input Penilaian -->
<form action="{{ route('penilaian.store') }}" method="POST">
    @csrf
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nama Siswa</th>
                <th>Kriteria</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select name="alternatif_id[]" class="form-control" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($alternatifs as $alt)
                        <option value="{{ $alt->id }}">{{ $alt->nama }} ({{ $alt->kelas }})</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="kriteria_id[]" class="form-control" required>
                        <option value="">-- Pilih Kriteria --</option>
                        @foreach($kriterias as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }} ({{ $k->kode }})</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="nilai[]" step="0.01" min="0" class="form-control" required>
                </td>
            </tr>
        </tbody>
    </table>
    <button type="submit" class="btn btn-success">Simpan Penilaian</button>
</form>

<!-- Data Penilaian Tersimpan -->
@if(count($penilaian) > 0)
<hr>
<h4 class="mt-4">📋 Data Penilaian Tersimpan</h4>
<table class="table table-bordered mt-2">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kriteria</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach($penilaian as $p)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $p->alternatif->nama ?? '-' }}</td>
            <td>{{ $p->kriteria->nama ?? '-' }} ({{ $p->kriteria->kode ?? '' }})</td>
            <td>{{ $p->nilai }}</td>
            <td>
                <a href="{{ route('penilaian.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('penilaian.destroy', $p->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin ingin menghapus penilaian ini?')" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p class="text-muted mt-3">Belum ada data penilaian tersimpan.</p>
@endif

@endsection