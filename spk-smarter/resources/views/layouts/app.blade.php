<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 15px;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            flex-grow: 1;
            padding: 30px;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h4 class="text-center py-4 border-bottom">SPK SMARTER</h4>
        <a href="/dashboard">🏠 Dashboard</a>
        <a href="{{ route('alternatif.index') }}">👨‍🎓 Data Alternatif</a>
        <a href="{{ route('kriteria.index') }}">📋 Data Kriteria</a>
        <a href="{{ route('penilaian.index') }}">📝 Penilaian Siswa</a>
        <a href="{{ route('perhitungan') }}">📊 Perhitungan</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="#" onclick="event.preventDefault(); if(confirm('Yakin ingin logout?')) document.getElementById('logout-form').submit();">
            🚪 Logout
        </a>
    </div>

    <div class="content">
        @yield('content')
    </div>
</body>

</html>