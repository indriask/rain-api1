<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | RAIN</title>

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
        <form action="{{ route('password.reset.post' , ['token' => $token  , 'email' => $email]) }}" method="POST">
            @csrf
            <div>
                <h1>Masukan Password Baru Kamu !</h1>
                @if (session('success'))
                    <div
                        style="background-color: rgb(133, 255, 133); color:#333; padding: 10px 20px; border-radius: 10px">
                        <p>{{ session('success') }}</p>
                    </div>
                @else
                @endif

                @if ($errors->any())
                    <div
                        style="background-color: rgb(255, 133, 133); color:#333; padding: 10px 20px; border-radius: 10px">
                        <p>{{ $errors->first() }}</p>
                    </div>
                @endif



                <div>
                    <label for="email-or-phone">Masukan Kata Sandi Baru</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" id="email-or-phone" required>
                        <div class="show-password">
                            <i class="bi bi-eye-slash"></i>
                            <i class="bi bi-eye d-none"></i>
                        </div>                    
                    </div>
                </div>
                <div>
                    <label for="kata-sandi">Masukan Konfirmasi Kata Sandi</label>
                    <div class="input-wrapper">
                        <input type="password" name="password_confirmation" id="kata-sandi" required>
                        <!-- new code start -->
                        <div class="show-password">
                            <i class="bi bi-eye-slash"></i>
                            <i class="bi bi-eye d-none"></i>
                        </div>
                        <!-- new code end -->
                    </div>
                </div>
                <div class="form-option">
                
                @csrf
                <button type="submit" name="masuk" class="btn btn-primary">Simpan</button>
            </div>
        </form>

    </div>

    <!-- signin js -->
    <script defer src="{{ asset('js/show-password.js') }}"></script>
</body>

</html>
