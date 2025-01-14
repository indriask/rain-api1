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

    <title>Kelola Perusahaan | RAIN</title>
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
                        <img src="{{ asset('storage/' . $user->$role->profile->photo_profile) }}" alt=""
                            class="profile-img rounded-circle shadow">
                        <span class="profile-name">{{ $fullName }}</span>
                    </div>
                    <div class="position-relative">
                        <input type="search" class="search-company bg-white border border-0 focus-ring shadow"
                            name="cari-perusahaan" placeholder="Cari perusahaan">
                        <i class="bi bi-search search-icon"></i>
                    </div>
                </div>
            </div>

            {{-- menampilkan semua lowongan magang yang tersedia --}}
            <div id="card-container" class="overflow-auto">
                <div id="vacancy-card-list-container" class="overflow-auto position-relative h-100">
                    <div id="data-lowongan" class="vacancy-card-list px-3 gap-3 mt-4">
                        {{-- vacancy card --}}

                        @foreach ($companies as $company)
                            <div class="daftar-pelamar__proposal-card bg-white p-4 position-relative">
                                <div class="cursor-pointer">
                                    <div class="d-flex align-items-center gap-3 border-bottom border-black pb-2">
                                        <img src="{{ asset('storage/' . $company->company->profile->photo_profile) }}"
                                            class="daftar-pelamar__proposal-card-profile rounded-pill" alt="">
                                        <div class="d-flex flex-column">
                                            <span class="daftar-pelamar__proposal-card-name fw-700"
                                                style="font-size: .95rem"
                                                title="">{{ ($company->company->profile->first_name ?? 'Username') . ' ' . $company->company->profile->last_name ?? null }}</span>
                                            <span class="daftar-pelamar__proposal-card-name" style="font-size: .85rem;"
                                                title="">{{ $company->email }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <button
                                            onclick="window.location.href='{{ route('admin-view-user-company', $company->id_user) }}'"
                                            class="bni-blue click-animation border border-0 text-white mx-auto rounded p-2"
                                            style="width: 120px;">Lihat</button>
                                    </div>
                                </div>
                                <button id="delete-user-btn" type="button"
                                    onclick="showDeleteUser({{ $company->id_user }})"
                                    class="daftar-pelamar__proposal-card-delete click-animation border border-0 cursor-pointer position-absolute top-0 end-0 bni-blue text-white">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        @endforeach
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

            {{-- pop up notifikasi berhail atau gagal hapus akun user --}}
            <div id="delete-user-notification"
                class="d-none position-absolute top-0 end-0 start-0 bottom-0 d-flex align-items-center justify-content-center"
                style="background-color: rgba(0, 0, 0, .4)">
                <div class="profile__profile-delete-account bg-white">
                    <div class="d-flex">
                        <button onclick="showDeleteUserNotification()"
                            class="profile__profile-close-btn click-animation ms-auto bni-blue text-white border border-0">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </div>
                    <div class="py-3 px-5">
                        <div class="position-relatve d-flex align-items-center justify-content-center">
                            <span class="fw-600 position-relative z-1" id="delete-user-notification-message"></span>
                            <img src="" alt="" id="delete-user-notification-icon"
                                class="position-absolute" style="aspect-ratio: 1/1; width: 60px; opacity: .4;">
                        </div>
                        <button id="delete-user-action-btn" onclick="showDeleteUserNotification()"
                            class="border border-0 click-animation click-animation bni-blue text-white d-block mx-auto fw-700 mt-4"
                            style="width: 120px; padding: 6px 10px; border-radius: 10px; font-size: .9rem">Tutup</button>
                    </div>
                </div>
            </div>

            {{-- pop up notifikasi custom --}}
            <div id="custom-notification"
                class="d-none position-absolute top-0 end-0 bottom-0 start-0 d-flex align-items-center justify-content-center z-1"
                style="background-color: rgba(0, 0, 0, .4)">
                <div class="bg-white py-5 px-3 rounded">
                    <div class="position-relative d-flex flex-column align-items-center">
                        <img id="custom-notification-icon" class="" src="" style="width: 60px;"
                            alt="">
                        <h6 class="position-relative z-1 fw-700 mb-0 mt-1" id="custom-notification-title"></h6>
                        <span class="text-body-secondary text-center" style="font-size: .85rem; width: 400px;"
                            id="custom-notification-message"></span>
                    </div>
                    <button
                        class="bni-blue text-white fw-700 rounded border border-0 d-block mx-auto mt-4 px-4 py-2 click-animation"
                        onclick="showCustomNotification()" style="font-size: .85rem;">Tutup</button>
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
    <script defer src="{{ asset('js/admin/kelola-perusahaan.js') }}"></script>

</body>

</html>
