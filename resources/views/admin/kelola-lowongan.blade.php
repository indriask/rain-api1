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
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <title>Dashborad | RAIN</title>
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

        {{-- main dashboard content --}}
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
                            <option>Pilih Jurusan</option>
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

            {{-- admin manage vacancy list --}}
            <div id="card-container" class="overflow-auto">
                <div id="vacancy-card-list-container" class="overflow-auto position-relative h-100">
                    <div class="vacancy-card-list px-3 gap-3 mt-4">
                        {{-- vacancy card --}}
                        @for ($i = 1; $i <= 4; $i++)
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

                                    <button onclick="showAdminManageVacancyDetail('{{ $i }}')"
                                        class="vacancy-detail border border-0 text-white mx-auto d-block mt">Lihat</button>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            {{-- admin manage vacancy detail --}}
            <div id="admin-manage-vacancy-detail"
                class="d-none position-absolute top-0 end-0 bottom-0 start-0 d-flex justify-content-center position-relative"
                style="background-color: rgba(0, 0, 0, .4)">
                <form method="POST" id="admin-manage-vacancy-detail-form" enctype="multipart/form-data"
                    class="dashboard__add-vacancy-company bg-white p-4 d-flex align-items-center justify-content-center gap-4 mt-3 position-relative">
                    <div id="admin-manage-vacancy-detail-input" class="w-50 d-block">
                        <div class="dashboard__add-vacancy-form">
                            <label for="gaji" class="fw-600">Gaji</label>
                            <div>
                                <input id="admin-manage-vacancy-salary" value="" type="text"
                                    style="width: 120px" class="focus-ring" name="jumlah">
                                <span class="mx-2">/</span>
                                <input id="admin-manage-vacancy-salary-type" type="text" style="width: 120px;"
                                    class="focus-ring" name="bulan">
                            </div>

                            <label for="judul" class="fw-600">Judul</label>
                            <input id="admin-manage-vacancy-title" type="text" name="judul" class="focus-ring">

                            <label for="jurusan" class="fw-600">Jurusan</label>
                            <input id="admin-manage-vacancy-major" type="text" name="jurusan" class="focus-ring">

                            <label for="lokasi" class="fw-600">Lokasi</label>
                            <input id="admin-manage-vacancy-location" type="text" name="lokasi"
                                class="focus-ring">

                            <label for="dibuka" class="fw-600">Dibuka</label>
                            <div>
                                <input id="admin-manage-vacancy-open" type="date" style="width: 120px"
                                    class="focus-ring" name="dibuka">
                                <span class="mx-2">-</span>
                                <input id="admin-manage-vacancy-close" type="date" style="width: 120px;"
                                    class="focus-ring" name="ditutup">
                            </div>

                            <label for="tipe-waktu" class="fw-600">Tipe waktu</label>
                            <div id="admin-manage-vacancy-time-type">
                                <div>
                                    <input type="radio" name="tipe-waktu" id="full time" value="full time">
                                    <label for="full time">Full time</label>
                                </div>
                                <div>
                                    <input type="radio" name="tipe-waktu" id="part time" value="part time">
                                    <label for="part time">Part time</label>
                                </div>
                            </div>

                            <label for="jenis" class="fw-600">Jenis</label>
                            <select id="admin-manage-vacancy-type" name="jenis" id="jenis"
                                class="focus-ring bg-white border border-0">
                                <option value="online">Online</option>
                                <option value="offline">Offline</option>
                            </select>

                            <label for="durasi" class="fw-600">Durasi</label>
                            <input id="admin-manage-vacancy-duration" type="text" name="durasi"
                                class="focus-ring">

                            <label for="status" class="fw-600">Status</label>
                            <div class="dashboard__add-vacancy-status bg-white">Unverified</div>

                            <label for="pendaftar" class="fw-600">Pendaftar</label>
                            <input id="admin-manage-vacancy-quota" type="text" name="pendaftar" id=""
                                class="focus-ring">
                        </div>
                    </div>
                    <div id="admin-manage-vacancy-detail-description" class="w-50 d-block">
                        <label for="detail-lowongan" class="fw-600 d-block">Detail lowongan</label>
                        <textarea id="admin-manage-vacancy-description" name="description" id="detail-lowongan"
                            class="dashboard__add-vacancy-textarea border border-0 focus-ring p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, natus numquam. Deserunt debitis sequi fugiat unde, natus non corporis dicta! Repudiandae temporibus sapiente hic iste, eaque eveniet a laboriosam iusto impedit totam. Excepturi, quae nesciunt!</textarea>
                    </div>
                    <div id="admin-manage-vacancy-detail-logo" class="d-none">
                        <h6 class="fw-700 text-center">Logo Perusahaan</h6>
                        <label for="company-logo"
                            class="dashboard__add-vacancy-logo cursor-pointer d-flex align-items-center justify-content-center flex-column">
                            <div>Format gambar JPG, PNG, JPEG.</div>
                            <i class="bi bi-plus-square"></i>
                        </label>
                        <input type="file" name="company-logo" id="company-logo" hidden>
                        <input id="admin-manage-vacancy-old-logo" type="text" name="old_company_logo" hidden>
                    </div>

                    <div class="position-absolute bottom-0 start-0 end-0 py-3 px-4 d-flex justify-content-between">
                        <button class="border border-0 bni-blue text-white fw-700"
                            onclick="backAdminManageVacancyDetail()" type="button">Kembali</button>
                        <button id="admin-manage-vacancy-next-btn"
                            class="d-block border border-0 bni-blue text-white fw-700"
                            onclick="nextAdminManageVacancyDetail()" type="button">Berikutnya</button>
                        <button id="admin-manage-vacancy-verify-btn"
                            class="d-none border border-0 bni-blue text-white fw-700" type="button"
                            onclick="showAdminManageVacancyVerify()">Verifikasi</button>
                    </div>
                    <button id="admin-manage-vacancy-edit-btn"
                        class="d-none border border-0 bni-blue text-white fw-700 position-absolute"
                        style="top: 10px; right: 10px;" onclick="processAdminManageVacancyEdit()"
                        type="button">Edit</button>
                </form>
            </div>

            {{-- admin manage vacancy verify --}}
            <div id="admin-manage-vacancy-verify"
                class="d-none position-absolute top-0 end-0 start-0 bottom-0 d-flex align-items-center justify-content-center"
                style="background-color: rgba(0, 0, 0, .4);">
                <div class="dashboard__logout bg-white" style="width: 600px;">
                    <div class="d-flex">
                        <button onclick="showAdminManageVacancyVerify()"
                            class="dashboard__close-btn ms-auto bni-blue text-white border border-0">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </div>
                    <div class="py-3 px-5">
                        <span class="fw-600 text-center d-block" style="font-size: .9rem;">Apakah anda yakin bahwa
                            seluruh informasi yang diberikan sudah benar?</span>
                        <h5 class="fw-700 text-center text-black mt-1">Lakukan verifikasi jika benar!</h6>
                            <button onclick="" id="admin-manage-vacancy-verify-btn-action"
                                class="border border-0 bni-blue text-white d-block mx-auto fw-700 mt-4"
                                style="width: 120px; padding: 6px 10px; border-radius: 10px; font-size: .9rem">Verifikasi</button>
                    </div>
                </div>
            </div>

            {{-- admin manage vacancy notification --}}
            <div id="admin-manage-vacancy-notification"
                class="d-none position-absolute top-0 end-0 bottom-0 start-0 d-flex justify-content-center"
                style="background-color: rgba(0, 0, 0, .4)">
                <div
                    class="dashboard__add-vacancy-notification bg-white p-4 mt-3 d-flex flex-column align-items-center justify-content-center">
                    <h5 id="admin-manage-vacancy-notification-title" class="fw-700"></h5>
                    <img id="admin-manage-vacancy-notification-image" src="" alt="Company logo">
                    <button class="border border-0 bni-blue text-white fw-700 position-relative"
                        onclick="showAdminManageVacancyNotification()">Tutup</button>
                </div>
            </div>

            {{-- admin manage vacancy verify notification --}}
            <div id="admin-manage-vacancy-verify-notification"
                class="d-none position-absolute top-0 end-0 bottom-0 start-0 d-flex align-items-center justify-content-center"
                style="background-color: rgba(0, 0, 0, .4)">
                <div
                    class="profile__profile-edit-notification bg-white p-5 d-flex justify-content-center align-items-center position-relative">
                    <div>
                        <h5 id="admin-manage-vacancy-verify-notification-title" class="fw-700 text-center">Lowongan berhasil diverifikasi!</h5>
                        <button onclick="showAdminManageVacancyVerifyNotification()"
                            class="profile__profile-edit-notification-btn border border-0 bni-blue fw-700 text-white d-block mx-auto mt-4">Tutup</button>
                    </div>
                    <img id="admin-manage-vacancy-verify-notification-image" src="" alt=""
                        class="profile__profile-success-edit-icon position-absolute">
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
