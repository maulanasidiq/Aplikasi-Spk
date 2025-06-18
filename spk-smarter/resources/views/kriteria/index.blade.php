@extends('layouts.app')

@section('title', 'Data Kriteria')

@section('content')
<h2>Data Kriteria</h2>

<a href="{{ route('kriteria.create') }}" class="btn btn-primary mb-3">+ Tambah Kriteria</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kriteria</th>
            <th>Bobot</th>
            <th>Jenis</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kriterias as $index => $kriteria)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $kriteria->nama }}</td>
            <td>{{ $kriteria->bobot }}</td>
            <td>{{ ucfirst($kriteria->jenis) }}</td>
            <td>
                <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus kriteria ini?')" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection