@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1>Selamat Datang, {{ Auth::user()->username }} 👋</h1>
<p class="lead">Ini adalah halaman utama aplikasi SPK dengan metode SMARTER.</p>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Jumlah Siswa</h5>
                <p class="card-text">35 Siswa</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Perhitungan Terakhir</h5>
                <p class="card-text">10 Juni 2025</p>
            </div>
        </div>
    </div>
</div>
@endsection