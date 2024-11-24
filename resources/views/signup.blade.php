<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up | RAIN</title>

    <!-- google fonts plus jakarta sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    {{-- bootstrap icon web font link --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- css link -->
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>

<body>

    <!-- bagian form signup mahasiswa -->
    <div class="form-container">



        <form action="" method="POST">
            @csrf
            <div>
                <h1>Daftarkan diri anda!</h1>

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
                    <label for="email-or-phone">Masukan Email/No. Handphone</label>
                    <div class="input-wrapper">
                        <input type="text" name="email_or_phone" id="email-or-phone" required>
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
                <div>
                    <label for="name">Nama Anda</label>
                    <div class="input-wrapper">
                        <input type="text" name="name" id="name" required>
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div>
                    <label for="kata-sandi">Kata Sandi</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" id="kata-sandi" required>
                        <!-- new code start -->
                        <div class="show-password">
                            <i class="bi bi-eye-slash"></i>
                            <i class="bi bi-eye d-none"></i>
                        </div>
                        <!-- new code end -->
                    </div>
                </div>
                <div>
                    <label for="konfirmasi-kata-sandi">Masukan Ulang Sandi</label>
                    <div class="input-wrapper">
                        <input type="password" name="password_confirmation" id="konfirmas-kata-sandi" required>
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

        <!-- bagian gambar ilustrasi form signup mahasiswa -->
        <div class="img-container shadow">
            <img src="{{ asset('storage/2d-logo.png') }}" class="form-ilustration" alt="Register to RAIN">
            <img src="{{ asset('storage/svg/Scribble-6.svg') }}" class="left-top-ilustration-1" alt="">
            <img src="{{ asset('storage/svg/Spiral-1.svg') }}" class="left-bottom-ilustration-1" alt="">
            <img src="{{ asset('storage/svg/Arrow-9.svg') }}" class="right-top-ilustration-1" alt="">
            <img src="{{ asset('storage/svg/Arrow-8.svg') }}" class="right-bottom-ilustration-1" alt="">
        </div>

    </div>

    <!-- kode js untuk melihat password -->
    <script defer src="{{ asset('js/show-password.js') }}"></script>
</body>

</html>
