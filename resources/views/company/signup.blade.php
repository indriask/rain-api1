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

    {{-- notifikasi email berhasil dikirim --}}
    @if (session('message'))
        <div class="position-absolute top-0 end-0 start-0 z-1">
            <div class="alert alert-success d-flex align-items-center mx-auto d-block mt-2 gap-1"
                style="width: fit-content;" role="alert">
                <i class="bi bi-"></i>
                <div style="font-size: .95rem;">
                    {{ session('message') }}
                </div>
            </div>
        </div>
    @endif

    {{-- notifikai error signup --}}
    @error('error')
        <div class="position-absolute top-0 end-0 start-0 z-1">
            <div class="alert alert-danger d-flex align-items-center mx-auto d-block mt-2 gap-1" style="width: fit-content;"
                role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <div style="font-size: .95rem;">
                    {{ $message }}
                </div>
            </div>
        </div>
    @enderror

    <!-- wrapper form dan gambar ilustrasi signup perusahaan -->
    <div class="form-container">
        {{-- form halaman signup perusahaan --}}
        <form action="{{ route('api-create-company-account') }}" method="POST" enctype="multipart/form-data">
            <div>
                <h1>Daftarkan perusahaan anda!</h1>
                <div>
                    <label for="email">Masukan Email</label>
                    <div class="input-wrapper">
                        <input type="text" name="email" id="email" required value="{{ old('email', null) }}">
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
                <div>
                    <label for="nib">Masukan NIB</label>
                    <div class="input-wrapper">
                        <input type="text" name="nib" id="nib" required value="{{ old('nib', null) }}">
                        <i class="bi bi-postcard"></i>
                    </div>
                </div>
                <div>
                    <label for="password">Kata Sandi</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" id="password" required>
                        <div class="show-password">
                            <i class="bi bi-eye-slash"></i>
                            <i class="bi bi-eye d-none"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="password_confirmation">Masukan Ulang Sandi</label>
                    <div class="input-wrapper">
                        <input type="password" name="password_confirmation" id="password_confirmation" required>
                        <div class="show-password">
                            <i class="bi bi-eye-slash"></i>
                            <i class="bi bi-eye d-none"></i>
                        </div>
                    </div>
                </div>
                <div class="input-wrapper">
                    <p class="file-label">Mauskan Bukti Surat Kerjasama Dengan Polibatam</p>
                    <label for="cooperation-file-input" id="cooperation-file-label" class="d-block">
                        <div class="box-surat d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-plus-square-fill"></i>
                            Tambahkan PDF atau DOCX
                        </div>
                    </label>
                    <input class="form-control input-surat" onchange="displayFile()" type="file"
                        name="cooperation_file" id="cooperation-file-input">

                    <div id="display-file-name-container" class="display-file d-none">
                        <div class="d-flex m-0 align-items-center justify-content-between">
                            <div class="m-0 d-flex align-items-center">
                                <i id="display-file-icon" class="bi me-1" style="font-size: 1.3rem;"></i>
                                <span id="display-file-name" class="display-file-name"></span>
                            </div>
                            <button class="border border-0 text-danger bg-transparent cursor-pointer"
                                onclick="displayFile()" type="button">
                                <i class="bi bi-trash" style="font-size: 1.1rem;"></i>
                            </button>
                        </div>
                    </div>

                </div>
                <button type="submit" name="daftar">Daftar</button>
            </div>
        </form>

        <!-- gambar ilustrasi halaman signup perusahaan -->
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
    <script defer src="{{ asset('js/file.js') }}"></script>


</body>

</html>
