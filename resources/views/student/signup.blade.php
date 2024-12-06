<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <!-- google fonts plus jakarta sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- bootstrap icon web font link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- css link -->
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>

<body>
    <!-- wrapper form dan gambar ilustrasi signup mahasiswa -->
    <div class="form-container">
        {{-- form halaman signup mahasisswa --}}
        <form action="{{ route('do-student-signup') }}" method="POST">
            @csrf
            <div>
                <h1>Daftarkan diri anda!</h1>
                <div>
                    <label for="email">Masukan Email</label>
                    <div class="input-wrapper">
                        <input type="text" name="email" id="email" required>
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
                <div>
                    <label for="nim">Masukan NIM</label>
                    <div class="input-wrapper">
                        <input type="text" name="nim" id="nim" required>
                        <i class="bi bi-postcard"></i>
                    </div>
                </div>
                <div>
                    <label for="password">Kata Sandi</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" id="password" required>
                        <!-- new code start -->
                        <div class="show-password">
                            <i class="bi bi-eye-slash"></i>
                            <i class="bi bi-eye d-none"></i>
                        </div>
                        <!-- new code end -->
                    </div>
                </div>
                <div>
                    <label for="password-confirmation">Masukan Ulang Sandi</label>
                    <div class="input-wrapper">
                        <input type="password" name="password-confirmation" id="password-confirmation" required>
                        <!-- new code start -->
                        <div class="show-password">
                            <i class="bi bi-eye-slash"></i>
                            <i class="bi bi-eye d-none"></i>
                        </div>
                        <!-- new code end -->
                    </div>
                </div>
                <button type="submit" name="daftar">Daftar</button>
            </div>
        </form>

        <!-- gambar ilustrasi halaman signuo mahasiswa -->
        <div class="img-container shadow-lg">
            <img src="{{ asset('storage/2d-logo.png') }}" class="form-ilustration" alt="Register to RAIN">
            <img src="{{ asset('storage/svg/Scribble-6.svg') }}" class="left-top-ilustration-1" alt="">
            <img src="{{ asset('storage/svg/Spiral-1.svg') }}" class="left-bottom-ilustration-1" alt="">
            <img src="{{ asset('storage/svg/Arrow-9.svg') }}" class="right-top-ilustration-1" alt="">
            <img src="{{ asset('storage/svg/Arrow-8.svg') }}" class="right-bottom-ilustration-1" alt="">
        </div>
    </div>

    <!-- script js untuk melihat password -->
    <script defer src="{{ asset('js/show-password.js') }}"></script>
</body>

</html>
