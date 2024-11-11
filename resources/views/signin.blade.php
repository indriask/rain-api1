<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in | RAIN</title>

    <!-- google fonts plus jakarta sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- bootstrap icon web font link --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- css link -->
    <link rel="stylesheet" href="{{ asset('css/signin.css') }}">
</head>

<body>

    <!-- bagian form signin mahasiswa -->
    <div class="form-container">

        <!-- bagian gambar ilustrasi form signin mahasiswa -->
        <div class="img-container shadow-lg">
            <img src="{{ asset('storage/2d-logo.png') }}" class="form-ilustration" alt="Login RAIN">
            <img src="{{ asset('storage/svg/Scribble-6.svg') }}" class="top-ilustration-1" alt="">
            <img src="{{ asset('storage/svg/Arrow-9.svg') }}" class="left-ilustration-1" alt="">
            <img src="{{ asset('storage/svg/Arrow-9.svg') }}" class="right-ilustration-1" alt="">
            <img src="{{ asset('storage/svg/Spiral-1.svg') }}" class="right-bottom-ilustration-1" alt="">
        </div>

        <!-- bagian form input mahasiswa -->
        <form action="{{ route('validate-credentials') }}" method="POST">
            <div>
                <h1>Dapatkan lowongan dan kandidat magang yang sesuai!</h1>
                <div>
                    <label for="email-or-phone">Masukan Email</label>
                    <div class="input-wrapper">
                        <input type="text" name="email" id="email" required>
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
                <div>
                    <label for="kata-sandi">Kata Sandi</label>
                    <div class="input-wrapper">
                        <input type="password" name="kata-sandi" id="kata-sandi" required>
                        <!-- new code start -->
                        <div class="show-password">
                            <i class="bi bi-eye-slash"></i>
                            <i class="bi bi-eye d-none"></i>
                        </div>
                        <!-- new code end -->
                    </div>
                </div>
                <div class="form-option">
                    <p>Tidak punya akun? <a href="{{ route('student-signup') }}">Daftar</a></p>
                    <a href="{{ route('forget-password') }}">Lupa password?</a>
                </div>
                @csrf
                <button type="submit" name="masuk">Masuk</button>
            </div>
        </form>

    </div>

    <!-- signin js -->
    <script defer src="{{ asset('js/show-password.js') }}"></script>
</body>

</html>
