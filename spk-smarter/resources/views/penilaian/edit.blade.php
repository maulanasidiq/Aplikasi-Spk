@extends('layouts.app')

@section('title', 'Edit Penilaian')

@section('content')
<h2>Edit Penilaian</h2>

<form action="{{ route('penilaian.update', $penilaian->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="alternatif_id">Nama Siswa</label>
        <select name="alternatif_id" class="form-control" required>
            @foreach($alternatifs as $alt)
            <option value="{{ $alt->id }}" {{ $penilaian->alternatif_id == $alt->id ? 'selected' : '' }}>
                {{ $alt->nama }} ({{ $alt->kelas }})
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="kriteria_id">Kriteria</label>
        <select name="kriteria_id" class="form-control" required>
            @foreach($kriterias as $krit)
            <option value="{{ $krit->id }}" {{ $penilaian->kriteria_id == $krit->id ? 'selected' : '' }}>
                {{ $krit->nama }} ({{ $krit->kode }})
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="nilai">Nilai</label>
        <input type="number" step="0.01" min="0" name="nilai" class="form-control" value="{{ $penilaian->nilai }}" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection