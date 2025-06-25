@extends('layouts.app')

@section('title', 'Edit Kriteria')

@section('content')
<h2>Edit Kriteria</h2>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $e)
        <li>{{ $e }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="kode" class="form-label">Kode</label>
        <input type="text" name="kode" value="{{ old('kode', $kriteria->kode) }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="nama" class="form-label">Nama Kriteria</label>
        <input type="text" name="nama" value="{{ old('nama', $kriteria->nama) }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="bobot" class="form-label">Bobot</label>
        <input type="number" step="0.01" name="bobot" value="{{ old('bobot', $kriteria->bobot) }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="jenis" class="form-label">Jenis</label>
        <select name="jenis" class="form-select" required>
            <option value="benefit" {{ old('jenis', $kriteria->jenis) == 'benefit' ? 'selected' : '' }}>Benefit</option>
            <option value="cost" {{ old('jenis', $kriteria->jenis) == 'cost' ? 'selected' : '' }}>Cost</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>
@endsection