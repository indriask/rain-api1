<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halo, Wawancara lowongan mu telah diterima</title>

    <!-- google fonts plus jakarta sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .notification-container {
            width: 500px;
        }

        .rain-logo {
            aspect-ratio: 1/1;
            width: 45px;
            object-fit: cover;
            object-position: center;
        }

        .rain-title {
            font-size: 1rem;
            font-weight: 600;
        }

        .success-icon {
            aspect-ratio: 1/1;
            width: 60px;
            object-fit: cover;
            object-position: center;
        }

        .message-container {
            font-size: .93rem;
        }
    </style>

</head>

<body class="d-flex align-items-center justify-content-center min-vh-100 bg-dark-subtle">

    <div class="notification-container bg-white px-3 py-4">
        <div class="d-flex align-items-center">
            <img class="rain-logo" src="{{ $message->embed(storage_path('app/public/2d-logo.png')) }}" alt="RAIN logo">
            <span class="rain-title">RAIN POLIBATAM</span>
        </div>
        <div class="mt-4">
            <img src="{{ $message->embed(storage_path('app/public/svg/success-checkmark.svg')) }}"
                class="success-icon d-block mx-auto" alt="">
            <div class="message-container mt-3 px-2">
                <p class="text-body-secondary my-0 mb-1" style="font-size: 1rem;">Halo {{ $studentFullName }}</p>
                <p class="text-body-secondary my-0">
                    Selamat 🎉🥳🥳, Wawancara anda telah <strong>diterima</strong> untuk program magang oleh
                    <strong>{{ $companyFullName }}</strong> dengan posisi sebagai <strong>{{ $vacancyTitle }}</strong>
                </p>
                <p class="text-body-secondary mt-3">Untuk informasi selanjutnya, silahkan hubungi perusahaan terkait</p>
                <a href="http://rain.test/dashboard/mahasiswa/list/lamaran"
                    class="btn btn-primary underline-none d-block mx-auto mt-4" style="width: fit-content;">Lihat daftar
                    lamaran</a>
            </div>
        </div>
    </div>

    <!-- js bootstrap link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
