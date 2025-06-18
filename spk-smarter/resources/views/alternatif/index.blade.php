@extends('layouts.app')

@section('title', 'Data Alternatif')

@section('content')
<h2>Data Siswa (Alternatif)</h2>

<a href="{{ route('alternatif.create') }}" class="btn btn-primary mb-3">+ Tambah Siswa</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($alternatifs as $index => $alt)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $alt->nama }}</td>
            <td>
                <a href="{{ route('alternatif.edit', $alt->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('alternatif.destroy', $alt->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus siswa ini?')" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection