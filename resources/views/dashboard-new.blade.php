<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- google fonts plus jakarta sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <!-- box icons cdn link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-- bootstrap icon web font link --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard-new.css') }}">

    <title>Dashborad | RAIN</title>
</head>

<body class="d-flex min-vh-100">
    {{-- dashboard aside start --}}
    <aside class="aside-nav border-end border-black px-2">
        <div class="d-flex align-items-center border-bottom border-black">
            <img class="logo-img" src="{{ asset('storage/2d-logo.png') }}" alt="RAIN Team">
            <h2 class="logo-title">RAIN</h2>
        </div>  
        <div class="aside-list py-4">
            <div class="border-bottom border-black" style="height: 300px;">
                <p class="aside-subheading">MENU UTAMA</p>
                <div class="aside-list-item py-2 px-2 text-white mb-2" onclick=""><i
                        class="bi bi-house-door me-1"></i> Beranda</div>
                <div class="aside-list-item py-2 px-2 text-white mb-2" onclick=""><i
                        class="bi bi-card-list me-1"></i> Daftar Lamaran</div>
                @if (false)
                    <div class="aside-list-item py-2 px-2 text-white mb-2" onclick=""><i
                            class="bi bi-plus-circle me-1"></i> Tambah Lowongan</div>
                    <div class="aside-list-item py-2 px-2 text-white mb-2" onclick=""><i
                            class="bi bi-window me-1"></i> Kelola Lowongan</div>
                    <div class="aside-list-item py-2 px-2 text-white mb-2" onclick=""><i
                            class="bi bi-person-vcard me-1"></i> Daftar Pelamar</div>
                @endif
            </div>
            <div class="">
                <p class="aside-subheading">Lainnya</p>
                <div class="aside-list-item py-2 px-2 text-white mb-2" onclick=""><i
                        class="bi bi-gear me-1"></i> Pengaturan</div>
                <div class="aside-list-item py-2 px-2 text-white mb-2" onclick=""><i
                        class="bi bi-box-arrow-left me-1"></i> Keluar</div>
            </div>
        </div>
    </aside>
    {{-- dashboard aside end --}}

    {{-- dashboard main start --}}
    <main class="dashboard-main">

        <div class="dashboard-main-nav border border-black d-flex align-items-center">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-1">
                    <img src="" alt="" class="rounded-cricle shadow">
                    <p>Wasyn Sulaiman Siregar</p>
                </div>
            </div>
        </div>

    </main>
    {{-- dashboard main end --}}

</body>

</html>
