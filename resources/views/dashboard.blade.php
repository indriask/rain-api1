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
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <title>Dashborad | RAIN</title>
</head>

<body>

    {{-- navbar section start --}}
    <nav class="navbar fixed-top p-2 bg-white mb-3">
        <div class="container p-0">
            <div onclick="window.location.href='{{ route('welcome') }}'" style="cursor: pointer">
                <a href="{{ route('welcome') }}">
                    <img src="{{ asset('storage/2d-logo.png') }}" class="rain-logo" alt="RAIN logo">
                </a>
                <span class="logo-title">RAIN</span>
            </div>
            <div class="custom-nav-list">
                <a href="{{ route('dashboard') }}">Beranda</a>
                <a href="{{ route('pasang-lowongan') }}">Pasang Lowongan</a>
            </div>
            <a href="">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZdwNBiQboKdExrMOqOu0HfTcF1ljCPs3ZtQ&s"
                    alt="Your profile" class="nav-profile rounded-pill shadow">
            </a>
        </div>
    </nav>
    {{-- navbar section end --}}

    {{-- dashboard content section start --}}
    <div class="dashboard-content-container container-fluid bg-white p-3">

        {{-- search contente section start --}}
        <div class="search-container position-relative mx-auto" style="margin-block: 3.5rem;">
            <input type="search" class="search-input rounded-pill focus-ring" name="cari" id="cari"
                placeholder="Cari">
            <button class="search-btn bi bi-search bg-white position-absolute"></button>
        </div>
        {{-- search content section end --}}

        {{-- vacancy display section start --}}
        <div class="container-fluid d-flex gap-5">
            <div class="filter-vacancy bg-white">
                <h3 class="mb-4">Filter</h4>
                    <select class="form-select rounded-pill mx-auto text-center" aria-label="Default select example">
                        <option selected>Lokasi</option>
                    </select>
                    <select class="form-select rounded-pill mx-auto text-center" aria-label="Default select example">
                        <option selected>Durasi</option>
                    </select>
                    <select class="form-select rounded-pill mx-auto text-center" aria-label="Default select example">
                        <option selected>Jurusan</option>
                    </select>
                    <select class="form-select rounded-pill mx-auto text-center" aria-label="Default select example">
                        <option selected>Prodi</option>
                    </select>
                    <select class="form-select rounded-pill mx-auto text-center" aria-label="Default select example">
                        <option selected>Gaji</option>
                    </select>
            </div>
            <div class="vacancy-list container-fluid">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                <div class="row gap-4 mb-4">
                    <div class="vacancy-card col bg-white p-3">
                        <div class="d-flex justify-content-between">
                            <h5 class="vacancy-card-heading">Rp. ***/bulan</h5>
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9Drwt3K0cWDDhzXpvQwb8PYeNeBbmCyjU4g&s"
                                alt="Company profile" class="vacancy-card-profile rounded">
                        </div>
                        <div class="mb-4">
                            <h6 class="vacancy-card-title">Frontend Developer</h6>
                            <p class="vacancy-card-jurusan">Teknik Informatika</p>
                            <div>
                                <i class="bi bi-geo-alt mb-1 d-block d-flex align-items-center gap-2">Nongsa, Batam</i>
                                <i class="bi bi-calendar3 mb-1 d-block d-flex align-items-center gap-2">20 September
                                    2024</i>
                                <i class="bi bi-file-bar-graph mb-1 d-block d-flex aling-items-center gap-2">30
                                    Kuota</i>
                            </div>
                        </div>
                        <div class="vacancy-type mb-3 d-flex align-items-center justify-content-center gap-3">
                            <div class="rounded-pill bg-white">Full-time</div>
                            <div class="rounded-pill bg-white">Kantor</div>
                            <div class="rounded-pill bg-white">6 Bulan</div>
                        </div>
                        <a href="{{ route('detail-lowongan', ['lowongan' => 'Frontend Developer']) }}"
                            style="text-decoration: none;">
                            <button class="vacancy-detail-btn bg-white d-block mx-auto rounded">Detail</button>
                        </a>
                    </div>
                    <div class="vacancy-card col bg-white p-3">
                        <div class="d-flex justify-content-between">
                            <h5 class="vacancy-card-heading">Rp. ***/bulan</h5>
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNSgh5mMT1E-oM0Y_5e14N5iZIxKfvo_Y8Vw&s"
                                alt="Company profile" class="vacancy-card-profile rounded">
                        </div>
                        <div class="mb-4">
                            <h6 class="vacancy-card-title">Data Analytic</h6>
                            <p class="vacancy-card-jurusan">Teknik Informatika</p>
                            <div>
                                <i class="bi bi-geo-alt mb-1 d-block d-flex align-items-center gap-2">Cakung, Jakarta
                                    Timur</i>
                                <i class="bi bi-calendar3 mb-1 d-block d-flex align-items-center gap-2">12 Juli
                                    2022</i>
                                <i class="bi bi-file-bar-graph mb-1 d-block d-flex aling-items-center gap-2">15
                                    Kuota</i>
                            </div>
                        </div>
                        <div class="vacancy-type mb-3 d-flex align-items-center justify-content-center gap-3">
                            <div class="rounded-pill bg-white">Full-time</div>
                            <div class="rounded-pill bg-white">Kantor</div>
                            <div class="rounded-pill bg-white">8 Bulan</div>
                        </div>
                        <a href="{{ route('detail-lowongan', ['lowongan' => 'Data Analytic']) }}"
                            style="text-decoration: none;">
                            <button class="vacancy-detail-btn bg-white d-block mx-auto rounded">Detail</button>
                        </a>
                    </div>
                    <div class="vacancy-card col bg-white p-3">
                        <div class="d-flex justify-content-between">
                            <h5 class="vacancy-card-heading">Rp. ***/bulan</h5>
                            <img src="https://plus.unsplash.com/premium_photo-1679697666526-a4a7ae1bd63f?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8YnVpbGRpbmclMjBmcm9udHxlbnwwfHwwfHx8MA%3D%3D"
                                alt="Company profile" class="vacancy-card-profile rounded">
                        </div>
                        <div class="mb-4">
                            <h6 class="vacancy-card-title">Business Development</h6>
                            <p class="vacancy-card-jurusan">Manajemen Bisnis</p>
                            <div>
                                <i class="bi bi-geo-alt mb-1 d-block d-flex align-items-center gap-2">Sekupang,
                                    Batam</i>
                                <i class="bi bi-calendar3 mb-1 d-block d-flex align-items-center gap-2">25 November
                                    2023</i>
                                <i class="bi bi-file-bar-graph mb-1 d-block d-flex aling-items-center gap-2">10
                                    Kuota</i>
                            </div>
                        </div>
                        <div class="vacancy-type mb-3 d-flex align-items-center justify-content-center gap-3">
                            <div class="rounded-pill bg-white">Full-time</div>
                            <div class="rounded-pill bg-white">Kantor</div>
                            <div class="rounded-pill bg-white">6 Bulan</div>
                        </div>
                        <a href="{{ route('detail-lowongan', ['lowongan' => 'Business Development']) }}"
                            style="text-decoration: none">
                            <button class="vacancy-detail-btn bg-white d-block mx-auto rounded">Detail</button>
                        </a>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
        {{-- vacancy display section end --}}

    </div>
    {{-- dashboard content section end --}}
</body>

</html>
