<!DOCTYPE html>
<html>
<head>
    <title>Aktivasi Akun Anda</title>
</head>
<body>
    <h1>Hello, {{ $name }}</h1>
    <p>Anda telah terdaftar menjadi kasir Haleluya Store! Silakan klik link berikut untuk mengaktifkan akun Anda:</p>
    <a href="{{ url('/login' . $token) }}">Aktivasi Akun</a>
    <p>Anda dapat login dengan menggunakan email ini dan password: <strong>{{ $password }}</strong></p>
    <p>Setelah login, silakan ganti password Anda untuk keamanan.</p>
    <p>Jika Anda tidak merasa melakukan pendaftaran, abaikan email ini.</p>
</body>
</html>