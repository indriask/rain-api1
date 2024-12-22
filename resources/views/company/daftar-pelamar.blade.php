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
    <link rel="stylesheet" href="{{ asset('css/daftar-pelamar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <title>Daftar Pelamar | RAIN</title>
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

    <div class="dashboard-layout">

        {{-- dashboard aside navigation --}}
        <x-dashboard-navbar :role="$role" />

        {{-- content dashboard utama --}}
        <main class="dashboard-main position-relative">
            {{-- profile user, search query dan filter input --}}
            <div class="dashboard-main-nav border-bottom border-black px-5 py-3">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center gap-1 mb-2">
                        <img src="{{ asset('storage/' . $user->$role->profile->photo_profile) }}"
                            alt="" class="profile-img rounded-circle shadow">
                        <span class="profile-name">{{ $fullName }}</span>
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
                            <option>Pilih jurusan</option>
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    <div class="select-container">
                        <select name="prodi" id="prodi">
                            <option>Pilih prodi</option>
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    <div class="select-container">
                        <select name="mode_kerja" id="mode_kerja">
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

            {{-- menampilkan list pelamar pada lowongan--}}
            <div id="card-container" class="overflow-auto">
                <div id="proposal-list-container" class="overflow-auto position-relative h-100">
                    <div id="applicant-list-data" class="daftar-pelamar__proposal-card-list px-3 gap-3 mt-4">
                    </div>
                </div>
            </div>

            {{-- profile pelamar mahasiswa --}}
            <div id="daftar-pelamar-student-profile-container"
                class="d-none position-absolute top-0 end-0 bottom-0 start-0 d-flex justify-content-center"
                style="background-color: rgba(0, 0, 0, .4)">
                {{-- informasi profile pelamar --}}
                <div id="daftar-pelamar-student-profile" class="w-100">
                </div>

                {{-- informasi proposal pelamar --}}
                <div id="daftar-pelamar-proposal-info-container"
                    class="d-none vacancy-apply-form-container position-absolute top-0 start-0 bottom-0 end-0 d-flex justify-content-center align-items-center flex-column py-4">
                </div>
            </div>

            {{-- pop up perbarui status lamaran mahasiswa --}}
            <div id="daftar-pelamar-update-proposal-status"></div>

            {{-- pop up opsi perbarui status lamaran mahasiswa --}}
            <div id="daftar-pelamar-update-option-proposal-status">
            </div>

            {{-- pop up notifikasi update status proposal --}}
            <div id="daftar-pelamar-update-proposal-status-notification">
            </div>

            {{-- pop up pesan konfirmasi penghapusan pelamar --}}
            <div id="daftar-pelamar-hapus-pelamar">
            </div>

            {{-- pop up notifikasi ingin logout --}}
            <x-logout-card />

            {{-- tambah lowongan untuk perusahaan --}}
            <div id="add-vacancy"></div>


        </main>
    </div>

    {{-- script jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- script js buat logika fitur pada halaman beranda dashboard mahasiswa, perusahaan dan admin --}}
    <script defer src="{{ asset('js/dashboard.js') }}"></script>

    {{-- script js buat logika fitur pada halaman daftar pelamar perusahaan --}}
    <script defer src="{{ asset('js/company/daftar-pelamar.js') }}"></script>

</body>

</html>
