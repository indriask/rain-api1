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

    {{-- js bootstrap link --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/daftar-pelamar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <title>Kelola Mahasiswa | RAIN</title>
    <script>
        window.laravel = {
            csrf_token: "{{ csrf_token() }}"
        };
        window.storage_path = {
            path: "{{ asset('storage') }}/"
        };
    </script>
</head>

<body>

    {{-- notifikasi data tidak ditemukan atau kosong --}}
    <div id="empty-data-list-notification" class="d-none position-absolute top-0 start-0 end-0 z-1 border border-black">
        <div class="alert alert-warning alert-dismissible fade show mx-auto mt-4" role="alert"
            style="width: fit-content; font-size: .9rem;">
            <div class="d-flex align-items-center gap-1">
                <i class="bi bi-exclamation-triangle"></i>
                <div id="empty-data-list-notification-title"></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    {{-- notifikasi berhasil atau gagal akun user dihapus --}}
    <div id="delete-user-notification" class="d-none position-absolute top-0 end-0 start-0 z-1 mt-4">
        <div class="alert alert-success alert-dismissible mx-auto fade show" role="alert" style="width: fit-content;">
            <i class="bi bi-trash-fill me-1"></i> <span id="delete-user-notification-message"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>


    <div class="dashboard-layout">

        {{-- navigasi dashboard samping --}}
        <x-dashboard-navbar :role="$role" />

        {{-- content dashboard utama --}}
        <main class="dashboard-main position-relative">

            {{-- profile user, search lowongan dan filter lowongan --}}
            <div class="dashboard-main-nav border-bottom border-black px-5 py-3">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center gap-1 mb-2">
                        {{-- <img src="{{ asset('storage/' . $user->$role->profile->photo_profile) }}" alt=""
                            class="profile-img rounded-circle shadow">
                        <span class="profile-name">{{ $fullName }}</span> --}}
                        <img src="{{ asset('storage/default/profile.png') }}" alt=""
                            class="profile-img rounded-circle shadow">
                        <span class="profile-name">Admin</span>
                    </div>
                    <div class="position-relative">
                        <input type="search" class="search-company bg-white border border-0 focus-ring shadow"
                            name="cari-perusahaan" placeholder="Cari perusahaan">
                        <i class="bi bi-search search-icon"></i>
                    </div>
                </div>
                <div class="select-container w-100 mt-2 d-flex gap-3">
                    <div class="select-container">
                        <select name="jurusan" id="jurusan">
                            <option value="">Pilih jurusan</option>
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    <div class="select-container">
                        <select name="prodi" id="prodi">
                            <option value="">Pilih prodi</option>
                        </select>
                        <div class="select-bg"></div>
                    </div>

                    <div class="select-container">
                        <select name="mode_kerja" id="">
                            <option value="" selected>Pilih lowongan</option>
                            <option value="offline">Offline</option>
                            <option value="online">Online</option>
                            <option value="hybrid">Hybrid</option>
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    <div class="select-container">
                        <select name="lokasi" id="lokasi">
                            <option>Pilih lokasi</option>
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    <button class="hapus-filter ms-auto">
                        <i class="bi bi-x-square me-1"></i>
                        Hapus filter
                    </button>
                </div>
            </div>

            {{-- menampilkan semua lowongan magang yang tersedia --}}
            <div id="card-container" class="overflow-auto">
                <div id="vacancy-card-list-container" class="overflow-auto position-relative h-100">
                    <div id="data-lowongan" class="vacancy-card-list px-3 gap-3 mt-4">
                        {{-- vacancy card --}}

                        @for ($i = 1; $i <= 12; $i++)
                            <div class="daftar-pelamar__proposal-card bg-white p-4 position-relative">
                                <div class="cursor-pointer">
                                    <div class="d-flex align-items-center gap-3 border-bottom border-black pb-2">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHr74Pjdj__bQPnZK-BFujbwgnP1t5PIqkig&s"
                                            class="daftar-pelamar__proposal-card-profile rounded-pill" alt="">
                                        <div class="d-flex flex-column">
                                            <span class="daftar-pelamar__proposal-card-name fw-700"
                                                style="font-size: .95rem" title="">Wasyn Sulaiman Siregar</span>
                                            <span class="daftar-pelamar__proposal-card-name"
                                                style="font-size: .85rem;"
                                                title="">wasynsulaiman@laravel.com</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <button
                                            onclick="window.location.href='{{ route('admin-view-user-student', $i) }}'"
                                            class="bni-blue click-animation border border-0 text-white mx-auto rounded p-2"
                                            style="width: 120px;">Lihat</button>
                                    </div>
                                </div>
                                <button id="delete-user-btn" type="button"
                                    onclick="showDeleteUser({{ $i }})"
                                    class="daftar-pelamar__proposal-card-delete click-animation border border-0 cursor-pointer position-absolute top-0 end-0 bni-blue text-white">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            {{-- pop up notifikasi ingin mnghapus akun ser --}}
            <div id="delete-user-verify"
                class="d-none position-absolute top-0 end-0 start-0 bottom-0 d-flex align-items-center justify-content-center"
                style="background-color: rgba(0, 0, 0, .4)">
                <div class="profile__profile-delete-account bg-white">
                    <div class="d-flex">
                        <button onclick="showDeleteUser()"
                            class="profile__profile-close-btn click-animation ms-auto bni-blue text-white border border-0">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </div>
                    <div class="py-3 px-5">
                        <span class="fw-600">Apakah anda yakin ingin menghapus akun ini?</span>
                        <button id="delete-user-action-btn" onclick=""
                            class="border border-0 click-animation bni-blue text-white d-block mx-auto fw-700 mt-4"
                            style="width: 120px; padding: 6px 10px; border-radius: 10px; font-size: .9rem">Hapus</button>
                    </div>
                </div>

            </div>

            {{-- pop up notifikasi ingin logout --}}
            <x-logout-card />

        </main>
    </div>

    {{-- script jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- script js buat logika fitur pada halaman beranda dashboard mahasiswa, perusahaan dan admin --}}
    <script defer src="{{ asset('js/dashboard.js') }}"></script>

    {{-- script js buat logika fitur pada halaman admin kelola user mahsiswa --}}
    <script defer src="{{ asset('js/admin/kelola-mahasiswa.js') }}"></script>

</body>

</html>
