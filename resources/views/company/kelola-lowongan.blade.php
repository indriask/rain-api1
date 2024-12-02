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

    <title>Kelola Lowongan | RAIN</title>
    <script>
        window.laravel = {
            csrf_token: "{{ csrf_token() }}"
        };
    </script>
</head>

<body>

    <div class="dashboard-layout">

        {{-- dashboard aside navigation --}}
        <x-dashboard-navbar :role="$role" />

        {{-- content dashboard utama --}}
        <main class="dashboard-main position-relative">
            {{-- user profile and filter input --}}
            <div class="dashboard-main-nav border-bottom border-black px-5 py-3">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center gap-1 mb-2">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQE6-KsNGUoKgyIAATW1CNPeVSHhZzS_FN0Zg&s"
                            alt="" class="profile-img rounded-circle shadow">
                        <span class="profile-name">Nama Mahasiswa</span>
                    </div>
                    <div class="position-relative">
                        <input type="search" class="search-company bg-white border border-0 focus-ring shadow"
                            name="cari-perusahaan" placeholder="Cari perusahaan">
                        <i class="bi bi-search search-icon"></i>
                    </div>
                </div>
                <div class="select-container w-100 mt-2 d-flex gap-3">
                    <div class="select-container">
                        <select name="" id="">
                            <option>Pilih jurusan</option>
                            <option>teknik informatika</option>
                            <option>teknik elektro</option>
                            <option>teknik mesin</option>
                            <option>teknologi rekayasa elektronik</option>
                            <option>teknologi rekayasa rekontruksi perkapalan</option>
                            <option>teknologi rekayasa pengelasan dan fabrikasi</option>
                            <option>tekn</option>
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    <div class="select-container">
                        <select name="" id="">
                            <option>Pilih prodi</option>
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    <div class="select-container">
                        <select name="" id="">
                            <option>Pilih lowongan</option>
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    <div class="select-container">
                        <select name="" id="">
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

            {{-- manage vacancy card list --}}
            <div id="card-container" class="overflow-auto">
                <div id="vacancy-card-list-container" class="overflow-auto position-relative h-100">
                    <div class="vacancy-card-list px-3 gap-3 mt-4">
                        {{-- manage vacancy card --}}
                        @for ($i = 0; $i < 4; $i++)
                            <div class="vacancy-card bg-white py-3 px-4">
                                <div class="d-flex justify-content-between">
                                    <h5 class="salary-text">Rp. ***/bulan</h5>
                                    <img class="company-photo rounded"
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbgAzqz4kY3Lte8GPpOfYnINyvZhPxXl5uSw&s"
                                        alt="Company photo">
                                </div>
                                <div>
                                    <h6 class="vacancy-role m-0">Frontend Developer</h6>
                                    <span class="vacancy-major-choice">Teknik Informatika</span>

                                    <ul class="vacancy-small-detail p-0 mt-3">
                                        <li><i class="bi bi-geo-alt me-3"></i>Nongsa, Batam</li>
                                        <li><i class="bi bi-calendar3 me-3"></i>20 September 2024</li>
                                        <li><i class="bi bi-bar-chart-line me-3"></i>30 Kuota</li>
                                    </ul>

                                    <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                        <li class="bg-white rounded-pill text-center">Full-time</li>
                                        <li class="bg-white rounded-pill text-center">Offline</li>
                                        <li class="bg-white rounded-pill text-center">6 Bulan</li>
                                    </ul>

                                    <button onclick="showManageVacancyCard('1')"
                                        class="vacancy-detail border border-0 text-white mx-auto d-block mt">Lihat</button>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            {{-- manage vacancy detail card --}}
            <div id="manage-vacancy-container"
                class="d-none position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center"
                style="background-color: rgba(0, 0, 0, .4)">
                <form id="manage-vacancy-form" method="POST" enctype="multipart/form-data"
                    class="dashboard__manage-vacancy-form bg-white p-4 d-flex align-items-center justify-content-center gap-4 mt-3 position-relative">
                    <div id="manage-vacancy-input" class="w-50 d-block">
                        <div class="dashboard__manage-vacancy-input">
                            <label for="gaji">Gaji</label>
                            <div>
                                <input type="text" style="width: 120px" class="focus-ring" name="jumlah"
                                    value="2.500.000">
                                <span class="mx-2">/</span>
                                <input type="text" style="width: 120px;" class="focus-ring" name="bulan"
                                    value="bulan">
                            </div>

                            <label for="judul" class="fw-600">Judul</label>
                            <input type="text" name="judul" class="focus-ring" value="Backend Developer">

                            <label for="jurusan" class="fw-600">Jurusan</label>
                            <select name="jurusan" id="jurusan"
                                class="bg-white border border-0 cursor-pointer focus-ring">
                                <option value="teknik informatika" selected>Teknik Informatika</option>
                                <option value="manajemen bisnis">Manajemen Bisnis</option>
                            </select>

                            <label for="lokasi" class="fw-600">Lokasi</label>
                            <input type="text" name="lokasi" class="focus-ring" value="Batam, Indonesia">

                            <label for="dibuka" class="fw-600">Dibuka</label>
                            <div>
                                <input type="date" style="width: 120px" class="focus-ring" name="dibuka">
                                <span class="mx-2">-</span>
                                <input type="date" style="width: 120px;" class="focus-ring" name="ditutup">
                            </div>

                            <label for="tipe-waktu" class="fw-600">Tipe waktu</label>
                            <div>
                                <div>
                                    <input type="radio" name="tipe-waktu" id="full-time" value="full-time">
                                    <label for="full-time">Full time</label>
                                </div>
                                <div>
                                    <input type="radio" checked name="tipe-waktu" value="part-time" id="part-time">
                                    <label for="part-time">Part time</label>
                                </div>
                            </div>

                            <label for="jenis" class="fw-600">Jenis</label>
                            <select name="jenis" id=""
                                class="focus-ring bg-white border border-0 cursor-pointer">
                                <option value="online">Online</option>
                                <option value="offline" selected>Offline</option>
                            </select>

                            <label for="durasi" class="fw-600">Durasi</label>
                            <input type="text" name="durasi" class="focus-ring" value="3 Bulan">

                            <label for="status" class="fw-600">Status</label>
                            <div class="dashboard__manage-vacancy-status bg-white">Verified</div>

                            <label for="pendaftar" class="fw-600">Pendaftar</label>
                            <input type="text" name="pendaftar" id="" value="30 Pelamar" class="focus-ring">
                        </div>
                    </div>
                    <div id="manage-vacancy-detail" class="w-50 d-block">
                        <label for="detail-lowongan" class="fw-600 d-block">Detail lowongan</label>
                        <textarea name="detail-lowongan" id="" class="dashboard__manage-vacancy-textarea border border-0 p-3"></textarea>
                    </div>
                    <div id="manage-vacancy-logo" class="d-none">
                        <h6 class="fw-700 text-center">Logo Perusahaan</h6>
                        <label for="company-logo"
                            class="dashboard__manage-vacancy-logo cursor-pointer d-flex align-items-center justify-content-center flex-column">
                            <div>Format gambar JPG, PNG, JPEG.</div>
                            <i class="bi bi-plus-square"></i>
                        </label>
                        <input type="file" name="company-logo" id="company-logo" hidden>
                    </div>
                    <div class="position-absolute bottom-0 start-0 end-0 py-3 px-4 d-flex justify-content-between">
                        <button id="manage-vacancy-back-form" class="border border-0 bni-blue text-white fw-700"
                            onclick="backManageVacancyForm()" type="button">Kembali</button>
                        <div class="d-flex gap-2">
                            <button id="manage-vacancy-next-form"
                                class="d-block border border-0 bni-blue text-white fw-700"
                                onclick="nextManageVacancyForm()" type="button">Berikutnya</button>
                            <button id="manage-vacancy-submit"
                                class="d-none border border-0 bni-blue text-white fw-700"
                                onclick="editManageVacancy(1)" type="button">Edit</button>
                        </div>
                    </div>
                </form>

                <div id="manage-vacancy-notification"
                    class="d-none dashboard__manage-vacancy-notification position-absolute bg-white p-4 mt-3 d-flex flex-column align-items-center justify-content-center">
                    <h5 id="manage-vacancy-notification-title" class="fw-700">Perubahan berhasil di simpan!</h5>
                    <img src="" alt="" id="manage-vacancy-notification-icon" class="fw-700">
                    <button class="border border-0 bni-blue text-white fw-700 position-relative" onclick="closeManageVacancyForm()">Kembali</button>
                </div>

            </div>

            {{-- pop up notifikasi ingin logout --}}
            <x-logout-card />

            {{-- tambah lowongan untuk perusahaan --}}
            <x-add-vacancy />

        </main>
    </div>

    <script defer src="{{ asset('js/dashboard.js') }}"></script>

</body>

</html>
