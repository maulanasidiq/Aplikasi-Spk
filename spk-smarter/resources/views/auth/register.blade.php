<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fdf0d5;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .left {
            width: 40%;
            background: #c0c0c0;
            color: black;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px;
            font-weight: bold;
        }

        .right {
            width: 60%;
            background: #fdf0d5;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .form-box {
            width: 60%;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background: #00aaff;
            border: none;
            padding: 12px 20px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
        }

        button:hover {
            background: #007bb5;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            Aplikasi Sistem <br> Pendukung Keputusan <br> Pemberian Sanksi <br> Pelanggaran Siswa <br> Menggunakan Metode SMARTER
        </div>
        <div class="right">
            <div class="form-box">
                <h2>DAFTAR AKUN</h2>
                @if ($errors->any())
                <div style="color: red;">
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <form action="{{ route('register.process') }}" method="POST">
                    @csrf
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Daftar</button>
                    <a href="/login"><button type="button">Kembali ke Login</button></a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>