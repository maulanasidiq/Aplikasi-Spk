@extends('layouts.app')

@section('title', 'Form Penilaian')

@section('content')
<h2>Form Penilaian</h2>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('penilaian.store') }}">
    @csrf

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                @foreach ($kriterias as $kriteria)
                <th>{{ $kriteria->nama }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($alternatifs as $index => $alt)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $alt->nama }}</td>
                @foreach ($kriterias as $kriteria)
                <td>
                    <select name="nilai[{{ $alt->id }}][{{ $kriteria->id }}]" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="90" {{ ($penilaian[$alt->id][$kriteria->id] ?? '') == 90 ? 'selected' : '' }}>81-100</option>
                        <option value="75" {{ ($penilaian[$alt->id][$kriteria->id] ?? '') == 75 ? 'selected' : '' }}>71-80</option>
                        <option value="65" {{ ($penilaian[$alt->id][$kriteria->id] ?? '') == 65 ? 'selected' : '' }}>61-70</option>
                        <option value="55" {{ ($penilaian[$alt->id][$kriteria->id] ?? '') == 55 ? 'selected' : '' }}>51-60</option>
                        <option value="40" {{ ($penilaian[$alt->id][$kriteria->id] ?? '') == 40 ? 'selected' : '' }}>0-50</option>
                    </select>
                </td>
                @endforeach
            </tr>
            @empty
            <tr>
                <td colspan="{{ 2 + count($kriterias) }}" class="text-center">Belum ada data alternatif.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-between">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Kembali</a>
        <button type="submit" class="btn btn-success">Simpan Penilaian</button>
    </div>
</form>
@endsection