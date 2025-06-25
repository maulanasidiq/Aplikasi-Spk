@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<h2>Edit Data Siswa</h2>

<form action="{{ route('alternatif.update', $alternatif->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nama" class="form-label">Nama Siswa</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $alternatif->nama) }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="kelas" class="form-label">Kelas</label>
        <input type="text" name="kelas" id="kelas" value="{{ old('kelas', $alternatif->kelas) }}" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
    <a href="{{ route('alternatif.index') }}" class="btn btn-secondary">↩️ Batal</a>
</form>
@endsection