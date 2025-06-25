@extends('layouts.app')

@section('title', 'Tambah Kriteria')

@section('content')
<h2>Tambah Kriteria</h2>

<form action="{{ route('kriteria.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="kode" class="form-label">Kode Kriteria</label>
        <input type="text" name="kode" class="form-control" required value="{{ old('kode') }}">
    </div>

    <div class="mb-3">
        <label for="nama" class="form-label">Nama Kriteria</label>
        <input type="text" name="nama" class="form-control" required value="{{ old('nama') }}">
    </div>

    <div class="mb-3">
        <label for="bobot" class="form-label">Bobot</label>
        <input type="number" step="0.01" name="bobot" class="form-control" required value="{{ old('bobot') }}">
    </div>

    <div class="mb-3">
        <label for="jenis" class="form-label">Jenis</label>
        <select name="jenis" class="form-control" required>
            <option value="">-- Pilih Jenis --</option>
            <option value="benefit" {{ old('jenis') == 'benefit' ? 'selected' : '' }}>Benefit</option>
            <option value="cost" {{ old('jenis') == 'cost' ? 'selected' : '' }}>Cost</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection