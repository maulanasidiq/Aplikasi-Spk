@extends('layouts.app')

@section('title', 'Data Alternatif')

@section('content')
<h2 class="mb-4">Data Siswa (Alternatif)</h2>

{{-- Tampilkan error validasi jika ada --}}
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Terjadi kesalahan!</strong>
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Form tambah siswa langsung di halaman --}}
<div class="card mb-4">
    <div class="card-header bg-primary text-white">Tambah Siswa Baru</div>
    <div class="card-body">
        <form action="{{ route('alternatif.store') }}" method="POST">
            @csrf
            <div class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="nama" class="form-control" placeholder="Nama siswa" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="kelas" class="form-control" placeholder="Kelas (Opsional)">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-success w-100">+ Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Tabel data siswa --}}
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th width="50">No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th width="160">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($alternatifs as $index => $alt)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $alt->nama }}</td>
            <td>{{ $alt->kelas ?? '-' }}</td>
            <td>
                <a href="{{ route('alternatif.edit', $alt->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('alternatif.destroy', $alt->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus siswa ini?')" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center text-muted">Belum ada data siswa.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection