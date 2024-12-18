<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in Admin | RAIN</title>

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

    {{-- notifikasi error signin --}}
    @error('error')
        <div class="position-absolute top-0 end-0 start-0 z-1">
            <div class="alert alert-danger d-flex align-items-center mx-auto d-block mt-2 gap-1" style="width: fit-content;"
                role="alert">
                <i class="bi bi-exclamation-triangle"></i>
                <div style="font-size: .95rem;">
                    {{ $message }}
                </div>
            </div>
        </div>
    @enderror

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
        <form action="{{ route('api-admin-validate-signin') }}" method="POST">
            <div>
                <h1>selamat datang admin RAIN!</h1>
                <div>
                    <label for="email-or-phone">Masukan Email</label>
                    <div class="input-wrapper m-0">
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" required>
                        <i class="bi bi-envelope"></i>
                    </div>
                    @error('email')
                        <div class="text-danger" style="font-size: .85rem;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="password">Kata Sandi</label>
                    <div class="input-wrapper m-0">
                        <input type="password" name="password" class="form-control @error('email') is-invalid @enderror"
                            id="password" required>
                        <div class="show-password">
                            <i class="bi bi-eye-slash"></i>
                            <i class="bi bi-eye d-none"></i>
                        </div>
                    </div>
                    @error('password')
                        <div class="text-danger" style="font-size: .85rem;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @csrf
                <button type="submit" name="masuk">Masuk</button>
            </div>
        </form>

    </div>
</body>

</html>
