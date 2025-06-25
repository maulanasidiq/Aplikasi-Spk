@extends('layouts.app')

@section('title', 'Data Kriteria')

@section('content')
<h2>Data Kriteria</h2>

<a href="{{ route('kriteria.create') }}" class="btn btn-primary mb-3">+ Tambah Kriteria</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Kriteria</th>
            <th>Bobot</th>
            <th>Jenis</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($kriterias as $index => $k)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $k->kode }}</td>
            <td>{{ $k->nama }}</td>
            <td>{{ $k->bobot }}</td>
            <td>{{ ucfirst($k->jenis) }}</td>
            <td>
                <a href="{{ route('kriteria.edit', $k->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('kriteria.destroy', $k->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus kriteria ini?')" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada data kriteria.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection