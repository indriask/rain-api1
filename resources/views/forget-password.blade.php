<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- google fonts plus jakarta sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    {{-- bootstrap icon web font link --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- css link -->
    <link rel="stylesheet" href="{{ asset('css/forget-password.css') }}">

    <title>Forget password | RAIN</title>
</head>

<body>

    <!-- bagian form forget password mahasiswa -->
    <div class="form-container">

        <!-- form input forget password -->
        <form action="{{route('forget-password-post')}}" method="POST">
            @csrf
            <div>
                <div class="form-title">
                    <h1>Atur ulang kata sandi anda!</h1>
                    <p>Tim RAIN akan mengirimkan link ke email Anda untuk membuat sandi baru.</p>
                </div>
                <div class="form-input">
                    <label for="email">Masukan email</label>
                    <div class="input-wrapper">
                        <input type="text" name="email" id="email">
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>

                <!-- bagian text konfimasik yang akan muncul -->
                <!-- ketika  mahasiswa sudah me-kelik tombol kirim -->
                <!-- <div class="confirmation-text">
                    Email sudah terkirim, silahkan cek email anda!
                </div> -->

                <button type="submit" name="daftar">Kirim</button>
                <div class="form-email-ilustration">
                    <img src="{{ asset('storage/svg/mailbox.svg') }}" alt="">
                </div>
            </div>
        </form>

        <!-- gambar ilustrasi form forget password -->
        <div class="img-container shadow">
            <img src="{{ asset('storage/2d-logo.png') }}" class="form-ilustration"
                alt="We will send an confirmation email before reseting your password">
            <img src="{{ asset('storage/svg/Arrow-8.svg') }}" class="top-left-ilustration-1" alt="">
            <img src="{{ asset('storage/svg/Scribble-6.svg') }}" class="top-right-ilustration-1" alt="">
            <img src="{{ asset('storage/svg/Scribble-6.svg') }}" class="bottom-left-ilustration-1" alt="">
            <img src="{{ asset('storage/svg/Spiral-1.svg') }}" class="bottom-right-ilustration-1" alt="">
        </div>
    </div>

</body>

</html>
