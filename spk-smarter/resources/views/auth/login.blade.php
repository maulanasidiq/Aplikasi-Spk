<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - Aplikasi SPK SMARTER</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
        }

        .left {
            background-color: #d3d3d3;
            /* abu-abu */
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .left h2 {
            font-size: 20px;
            text-align: center;
            line-height: 1.6;
        }

        .right {
            background-color: #fdf0d5;
            /* krem */
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0 60px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
        }

        .btn {
            width: 100%;
            padding: 10px;
            color: white;
            background-color: #009dff;
            border: none;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #007acc;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="left">
        <h2>
            Aplikasi Sistem<br>
            Pendukung<br>
            Keputusan<br>
            Pemberian Sanksi<br>
            Pelanggaran Siswa<br>
            Menggunakan<br>
            Metode SMARTER
        </h2>
    </div>

    <div class="right">
        <h1>SELAMAT DATANG</h1>

        @if(session('error'))
        <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button class="btn" type="submit">Login</button>
            <button class="btn" type="button" onclick="window.location.href='/register'">Daftar</button>
        </form>
    </div>
</body>

</html>