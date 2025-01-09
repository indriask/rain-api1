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

    <title>Beranda | RAIN</title>
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

    @error('error')
        <div id="custom-notification"
            class="d-block position-absolute top-0 end-0 bottom-0 start-0 d-flex align-items-center justify-content-center z-1"
            style="background-color: rgba(0, 0, 0, .4)">
            <div class="bg-white py-5 px-3 rounded">
                <div class="position-relative d-flex flex-column align-items-center">
                    <img id="custom-notification-icon" class="" src="{{ asset('storage/svg/failed-x.svg') }}"
                        style="width: 60px;" alt="">
                    <h6 class="position-relative z-1 fw-700 mb-0 mt-1" id="custom-notification-title">Gagal mengirim lamaran
                    </h6>
                    <span class="text-body-secondary text-center" style="font-size: .85rem; width: 400px;"
                        id="custom-notification-message">{{ $message }}</span>
                </div>
                <button
                    class="bni-blue text-white fw-700 rounded border border-0 d-block mx-auto mt-4 px-4 py-2 click-animation"
                    onclick="showCustomNotification()" style="font-size: .85rem;">Tutup</button>
            </div>
        </div>
    @enderror

    @if (session()->has('success'))
        <div id="custom-notification"
            class="d-block position-absolute top-0 end-0 bottom-0 start-0 d-flex align-items-center justify-content-center z-1"
            style="background-color: rgba(0, 0, 0, .4)">
            <div class="bg-white py-5 px-3 rounded">
                <div class="position-relative d-flex flex-column align-items-center">
                    <img id="custom-notification-icon" class=""
                        src="{{ asset('storage/svg/success-checkmark.svg') }}" style="width: 60px;" alt="">
                    <h6 class="position-relative z-1 fw-700 mb-0 mt-1" id="custom-notification-title">Berhasil mengirim
                        lamaran
                    </h6>
                    <span class="text-body-secondary text-center" style="font-size: .85rem; width: 400px;"
                        id="custom-notification-message">{{ session('success') }}</span>
                </div>
                <button
                    class="bni-blue text-white fw-700 rounded border border-0 d-block mx-auto mt-4 px-4 py-2 click-animation"
                    onclick="showCustomNotification()" style="font-size: .85rem;">Tutup</button>
            </div>
        </div>
    @endif

    <div class="dashboard-layout">

        {{-- navigasi dashboard samping --}}
        <x-dashboard-navbar :role="$role" />

        {{-- content dashboard utama --}}
        <main class="dashboard-main position-relative">

            {{-- profile user, search lowongan dan filter lowongan --}}
            <div class="dashboard-main-nav border-bottom border-black px-5 py-3">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center gap-1 mb-2">
                        <img src="{{ asset('storage/' . $user->$role->profile->photo_profile) }}" alt=""
                            class="profile-img rounded-circle shadow">
                        <span class="profile-name">{{ $fullName }}</span>
                    </div>
                    <div class="position-relative">
                        {{-- <input type="search" id="search-lowongan" class="search-company bg-white border border-0 focus-ring shadow"
                        name="cari-perusahaan" placeholder="Cari perusahaan"> --}}
                        <input type="text" id="search-lowongan"
                            class="search-company bg-white border border-0 focus-ring shadow"
                            placeholder="Cari berdasarkan judul lowongan">
                        <i class="bi bi-search search-icon"></i>
                    </div>

                </div>
                <div class="select-container w-100 mt-2 d-flex gap-3">
                    <div class="select-container">
                        <select name="jurusan2" id="jurusan2">
                            <option value="" disabled selected>Pilih Jurusan</option>
                            @foreach ($majors as $major)
                                <option value="{{ $major->name }}">{{ $major->name }}</option>
                            @endforeach
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    {{-- <div class="select-container">
                        <select name="prodi" id="prodi">
                            <option>Pilih prodi</option>
                        </select>
                        <div class="select-bg"></div>
                    </div> --}}
                    <div class="select-container">
                        <select name="mode_kerja" id="mode_kerja">
                            <option value="" disabled selected>Pilih lowongan</option>
                            @foreach ($vacancies as $vacancy)
                                <option value="{{ $vacancy->title }}">{{ $vacancy->title }}</option>
                            @endforeach
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    <div class="select-container">
                        <select name="lokasi" id="lokasipekerjaan">
                            <option value="" disabled selected>Pilih lokasi</option>
                            @foreach ($vacancies as $vacancy)
                                <option value="{{ $vacancy->location }}">{{ $vacancy->location }}</option>
                            @endforeach
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    <div>
                        <button class="hapus-filter" onclick="closeFilter()" style="height: 35px;">
                            <i class="bi bi-x-square me-1"></i>
                            <span id="filter-btn-text">Hapus filter</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- menampilkan semua lowongan magang yang tersedia --}}
            <div id="card-container" class="overflow-auto">
                <div id="vacancy-card-list-container" class="overflow-auto position-relative h-100">
                    <div id="data-lowongan" class="vacancy-card-list px-3 gap-3 mt-4">
                        {{-- Iterasi data vacancies --}}
                        @foreach ($vacancies as $vacancy)
                            <div class="vacancy-card bg-white py-3 px-4">
                                <div class="d-flex justify-content-between">
                                    <h5 class="salary-text">Rp.
                                        {{ number_format($vacancy->salary, 0, ',', '.') }}/bulan</h5>
                                    <img class="company-photo rounded"
                                        src="{{ asset('storage/' . $vacancy->photo_profile) }}" alt="Company photo">
                                </div>
                                <div>
                                    <h6 class="vacancy-role m-0">{{ $vacancy->title }}</h6>
                                    <span class="vacancy-major-choice">{{ $vacancy->major_name }}</span>

                                    <ul class="vacancy-small-detail p-0 mt-3">
                                        <li><i class="bi bi-geo-alt me-3"></i>{{ $vacancy->vacancy_location }}</li>
                                        <li><i
                                                class="bi bi-calendar3 me-3"></i>{{ \Carbon\Carbon::parse($vacancy->date_created)->format('d F Y') }}
                                        </li>
                                        <li><i class="bi bi-bar-chart-line me-3"></i>{{ $vacancy->quota }} Kuota</li>
                                    </ul>

                                    <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                        <li class="bg-white rounded-pill text-center">{{ $vacancy->vacancy_type }}
                                        </li>
                                        <li class="bg-white rounded-pill text-center">{{ $vacancy->time_type }}</li>
                                        <li class="bg-white rounded-pill text-center">{{ $vacancy->duration }} Bulan
                                        </li>
                                    </ul>

                                    <button onclick="showVacancyDetailCard('{{ $vacancy->id_vacancy }}')"
                                        class="vacancy-detail border border-0 text-white mx-auto d-block click-animation">Lihat</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- bagian untuk menampilan detail lowongan --}}
            <div id="vacancy-detail-card"
                class="d-none position-absolute vacancy-apply-form top-0 start-0 bottom-0 end-0 d-flex justify-content-center overflow-auto">
            </div>

            {{-- form daftar lowongan mahasiswa --}}
            <div id="vacancy-apply-form-container"
                class="d-none pe-none vacancy-apply-form-container position-absolute top-0 start-0 bottom-0 end-0 d-flex justify-content-center align-items-center flex-column py-4">

                {{-- form input isi data diri mahasiswa --}}
                <form id="vacancy-apply-form" action="{{ route('apply') }}" method="POST"
                    class="vacancy-apply-form-card bg-white p-4" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex justify-content-between">
                        <h1 class="vacancy-apply-form-card-title fw-700 mb-0">Formulir Lamaran</h1>
                        <button type="button" class="border border-0 bg-transparent click-animation"
                            onclick="showApplyVacancyFormContainer()"><i class="bi bi-x-circle"></i></button>
                    </div>
                    <span class="vacancy-apply-form-card-small-info">Silahkan mengisi formulir dibawah ini dengan
                        ketentuan berikut</span>

                    <div class="apply-form-common-info mt-4">
                        <h5 class="apply-form-common-info-heading fw-700 mb-3">Informasi dasar</h5>
                        <input type="text" class="w-100 border focus-ring mb-3" placeholder="Nama Lengkap"
                            name="nama">
                        <input type="text" class="w-100 border focus-ring mb-3" placeholder="NIM" name="">
                        <select name="" id="" class="w-100 border focus-ring mb-3">
                            <option selected>Jurusan</option>
                            <option value="teknik informatika">Teknik Informatika</option>
                            <option value="manajemen bisnis">Manajemen Bisnis</option>
                            <option value="teknik elektro">Teknik Elektro</option>
                            <option value="teknik mesin">Teknik Mesin</option>
                        </select>
                        <input type="text" class="w-100 border focus-ring mb-3" placeholder="Program Studi"
                            name="program-studi">
                        <input type="text" class="w-100 border focus-ring mb-3" placeholder="Email"
                            name="email">
                        <input type="text" class="w-100 border focus-ring mb-3" placeholder="Nomor Telepon"
                            name="nomor-telepon">
                    </div>

                    <h5 class="apply-form-common-info-heaing fw-700 mb-0">Informasi Tambahan</h5>
                    <div class="apply-form-upload-file-info d-flex justify-content-between">
                        <span>Dapat berupa CV atau dokumen lainnya</span>
                        <span>Maks. 6 Dokumen</span>
                    </div>
                    <label for="upload-file"
                        class="apply-form-upload-file text-white fw-700 text-center w-100 cursor-pointer">
                        <i class="bi bi-plus-square me-1"></i>Tambahkan PDF atau docx</label>
                    <input type="file" name="resume[]" multiple="true" id="upload-file" hidden>

                    <input type="hidden" name="id_vacancy" value="" id="daftar-lowongan-id-vacancy">

                    <button type="submit"
                        class="apply-form-common-info-btn border border-0 click-animation text-white fw-700 d-block mx-auto mt-2 text-center">Kirim</button>
                </form>

                {{-- notifikasi gagal atau sukses daftar lowongan mahasiswa --}}
                <div id="apply-form-notification" class="d-none pe-none vacancy-apply-form-card bg-white p-5 rounded">
                    <div class="d-flex align-items-center justify-content-center flex-column">
                        {{-- success message --}}
                        <img class="apply-form-icon ratio-1x1" src="{{ asset('storage/svg/success-checkmark.svg') }}"
                            alt="Success checkmar">
                        <span>Lamaran berhasil di kirim!</span>

                        <button onclick="closeAllFormCard()" class="bni-blue border border-0 text-white mt-5 rounded"
                            style="width: 100px; padding: 5px;">Kembali</button>
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

            {{-- tambah lowongan untuk perusahaan, hanya muncul jika role user adalah company --}}
            <div id="add-vacancy"></div>
        </main>
    </div>

    {{-- <div class="modal fade" id="vacancyDetailModal" tabindex="-1" aria-labelledby="vacancyDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vacancyDetailModalLabel">Vacancy Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Vacancy detail content will be injected here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Event listener ketika select lowongan berubah
            $('#mode_kerja').on('change', function() {
                const selectedTitle = $(this).val(); // Ambil lowongan yang dipilih
                $('#data-lowongan').empty();

                // Lakukan request ke backend dengan lowongan yang dipilih
                $.ajax({
                    url: '/filter-vacancies-by-title', // URL endpoint untuk filter
                    type: 'GET',
                    data: {
                        title: selectedTitle
                    },
                    success: function(response) {
                        // Bersihkan container lowongan sebelum menampilkan data baru

                        // Periksa apakah ada data lowongan
                        if (response.length > 0) {
                            console.log('kerenabng');
                            response.forEach(function(vacancy) {
                                const card = `
                                <div class="vacancy-card bg-white py-3 px-4">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="salary-text">Rp. ${new Intl.NumberFormat('id-ID').format(vacancy.salary)}/bulan</h5>
                                        <img class="company-photo rounded"
                                            src="${window.storage_path.path + vacancy.photo_profile}"
                                            alt="Company photo">
                                    </div>
                                    <div>
                                        <h6 class="vacancy-role m-0">${vacancy.title}</h6>
                                        <span class="vacancy-major-choice">${vacancy.major_name}</span>
                                        <ul class="vacancy-small-detail p-0 mt-3">
                                            <li><i class="bi bi-geo-alt me-3"></i>${vacancy.vacancy_location}</li>
                                            <li><i class="bi bi-calendar3 me-3"></i>${new Date(vacancy.date_created).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</li>
                                            <li><i class="bi bi-bar-chart-line me-3"></i>${vacancy.quota} Kuota</li>
                                        </ul>
                                        <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                            <li class="bg-white rounded-pill text-center">${vacancy.vacancy_type}</li>
                                            <li class="bg-white rounded-pill text-center">${vacancy.time_type}</li>
                                            <li class="bg-white rounded-pill text-center">${vacancy.duration} Bulan</li>
                                        </ul>
                                        <button onclick="showVacancyDetailCard('${vacancy.id_vacancy}')"
                                            class="vacancy-detail border border-0 click-animation text-white mx-auto d-block mt">Lihat</button>
                                    </div>
                                </div>
                            `;
                                $('#data-lowongan').append(card);
                            });
                        } else {
                            $('#data-lowongan').html(
                                '<p class="text-center">Tidak ada lowongan ditemukan.</p>');
                        }
                    },
                    error: function() {
                        console.error('Terjadi kesalahan saat memuat data.');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Event listener ketika select jurusan berubah
            $('#jurusan2').on('change', function() {
                const selectedMajor = $(this).val(); // Ambil jurusan yang dipilih

                // Lakukan request ke backend dengan jurusan yang dipilih
                $.ajax({
                    url: '/filter-vacancies-by-major', // URL endpoint untuk filter
                    type: 'GET',
                    data: {
                        major: selectedMajor
                    },
                    success: function(response) {
                        // Bersihkan container lowongan sebelum menampilkan data baru
                        $('#data-lowongan').empty();

                        // Periksa apakah ada data lowongan
                        if (response.length > 0) {
                            response.forEach(function(vacancy) {
                                const card = `
                                    <div class="vacancy-card bg-white py-3 px-4">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="salary-text">Rp. ${new Intl.NumberFormat('id-ID').format(vacancy.salary)}/bulan</h5>
                                            <img class="company-photo rounded"
                                                src="${window.storage_path.path + vacancy.photo_profile}"
                                                alt="Company photo">
                                        </div>
                                        <div>
                                            <h6 class="vacancy-role m-0">${vacancy.title}</h6>
                                            <span class="vacancy-major-choice">${vacancy.major_name}</span>
                                            <ul class="vacancy-small-detail p-0 mt-3">
                                                <li><i class="bi bi-geo-alt me-3"></i>${vacancy.vacancy_location}</li>
                                                <li><i class="bi bi-calendar3 me-3"></i>${new Date(vacancy.date_created).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</li>
                                                <li><i class="bi bi-bar-chart-line me-3"></i>${vacancy.quota} Kuota</li>
                                            </ul>
                                            <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                                <li class="bg-white rounded-pill text-center">${vacancy.vacancy_type}</li>
                                                <li class="bg-white rounded-pill text-center">${vacancy.time_type}</li>
                                                <li class="bg-white rounded-pill text-center">${vacancy.duration} Bulan</li>
                                            </ul>
                                            <button onclick="showVacancyDetailCard('${vacancy.id_vacancy}')"
                                                class="vacancy-detail border click-animation border-0 text-white mx-auto d-block mt">Lihat</button>
                                        </div>
                                    </div>
                                `;
                                $('#data-lowongan').append(card);
                            });
                        } else {
                            $('#data-lowongan').html(
                                '<p class="text-center">Tidak ada lowongan ditemukan untuk jurusan ini.</p>'
                            );
                        }
                    },
                    error: function() {
                        console.error('Terjadi kesalahan saat memuat data.');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Event listener ketika select lokasi berubah
            $('#lokasipekerjaan').on('change', function() {
                const selectedLocation = $(this).val(); // Ambil lokasi yang dipilih

                // Lakukan request ke backend dengan lokasi yang dipilih
                $.ajax({
                    url: '/filter-vacancies-by-location', // Endpoint filter
                    type: 'GET',
                    data: {
                        location: selectedLocation
                    },
                    success: function(response) {
                        // Bersihkan container lowongan sebelum menampilkan data baru
                        $('#data-lowongan').empty();

                        // Periksa apakah ada data lowongan
                        if (response.length > 0) {
                            response.forEach(function(vacancy) {
                                const card = `
                                <div class="vacancy-card bg-white py-3 px-4">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="salary-text">Rp. ${new Intl.NumberFormat('id-ID').format(vacancy.salary)}/bulan</h5>
                                        <img class="company-photo rounded"
                                            src="${window.storage_path.path + vacancy.photo_profile}"
                                            alt="Company photo">
                                    </div>
                                    <div>
                                        <h6 class="vacancy-role m-0">${vacancy.title}</h6>
                                        <span class="vacancy-major-choice">${vacancy.major_name}</span>
                                        <ul class="vacancy-small-detail p-0 mt-3">
                                            <li><i class="bi bi-geo-alt me-3"></i>${vacancy.vacancy_location}</li>
                                            <li><i class="bi bi-calendar3 me-3"></i>${new Date(vacancy.date_created).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</li>
                                            <li><i class="bi bi-bar-chart-line me-3"></i>${vacancy.quota} Kuota</li>
                                        </ul>
                                        <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                            <li class="bg-white rounded-pill text-center">${vacancy.vacancy_type}</li>
                                            <li class="bg-white rounded-pill text-center">${vacancy.time_type}</li>
                                            <li class="bg-white rounded-pill text-center">${vacancy.duration} Bulan</li>
                                        </ul>
                                        <button onclick="showVacancyDetailCard('${vacancy.id_vacancy}')"
                                            class="vacancy-detail border border-0 click-animation text-white mx-auto d-block mt">Lihat</button>
                                    </div>
                                </div>
                            `;
                                $('#data-lowongan').append(card);
                            });
                        } else {
                            $('#data-lowongan').html(
                                '<p class="text-center">Tidak ada lowongan ditemukan untuk lokasi ini.</p>'
                            );
                        }
                    },
                    error: function() {
                        console.error('Terjadi kesalahan saat memuat data.');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Event listener untuk tombol hapus filter
            $('.hapus-filter').on('click', function() {
                // Reset semua select dropdown ke default
                $('#lokasipekerjaan').val(''); // Reset lokasi
                $('#mode_kerja').val(''); // Reset lowongan
                $('#jurusan2').val(''); // Reset jurusan (jika ada)

                // Panggil kembali semua data vacancy tanpa filter
                $.ajax({
                    url: '/filter-vacancies-clear', // Endpoint untuk mengambil semua data
                    type: 'GET',
                    success: function(response) {
                        // Bersihkan container lowongan sebelum menampilkan data baru
                        $('#data-lowongan').empty();

                        // Periksa apakah ada data lowongan
                        if (response.length > 0) {
                            response.forEach(function(vacancy) {
                                const card = `
                                <div class="vacancy-card bg-white py-3 px-4">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="salary-text">Rp. ${new Intl.NumberFormat('id-ID').format(vacancy.salary)}/bulan</h5>
                                        <img class="company-photo rounded"
                                            src="${window.storage_path.path + vacancy.photo_profile}"
                                            alt="Company photo">
                                    </div>
                                    <div>
                                        <h6 class="vacancy-role m-0">${vacancy.title}</h6>
                                        <span class="vacancy-major-choice">${vacancy.major_name}</span>
                                        <ul class="vacancy-small-detail p-0 mt-3">
                                            <li><i class="bi bi-geo-alt me-3"></i>${vacancy.vacancy_location}</li>
                                            <li><i class="bi bi-calendar3 me-3"></i>${new Date(vacancy.date_created).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</li>
                                            <li><i class="bi bi-bar-chart-line me-3"></i>${vacancy.quota} Kuota</li>
                                        </ul>
                                        <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                            <li class="bg-white rounded-pill text-center">${vacancy.vacancy_type}</li>
                                            <li class="bg-white rounded-pill text-center">${vacancy.time_type}</li>
                                            <li class="bg-white rounded-pill text-center">${vacancy.duration} Bulan</li>
                                        </ul>
                                        <button onclick="showVacancyDetailCard('${vacancy.id_vacancy}')"
                                            class="vacancy-detail border click-animation border-0 text-white mx-auto d-block mt">Lihat</button>
                                    </div>
                                </div>
                            `;
                                $('#data-lowongan').append(card);
                            });
                        } else {
                            $('#data-lowongan').html(
                                '<p class="text-center">Tidak ada lowongan tersedia.</p>');
                        }
                    },
                    error: function() {
                        console.error('Terjadi kesalahan saat memuat data.');
                    }
                });
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            // Event untuk menangkap input pencarian
            $('#search-lowongan').on('input', function() {
                console.log($('#search-lowongan')); // Memastikan elemen input ditemukan
                console.log($('#data-lowongan .vacancy-card')); // Memastikan elemen lowongan ditemukan


                var searchText = $(this).val()
                    .toLowerCase(); // Ambil teks pencarian dan ubah menjadi huruf kecil

                // Iterasi melalui setiap lowongan
                $('#data-lowongan .vacancy-card').each(function() {
                    var title = $(this).find('.vacancy-role').text()
                        .toLowerCase(); // Ambil teks dari title

                    // Periksa apakah teks pencarian ada dalam title
                    if (title.includes(searchText)) {
                        $(this).show(); // Tampilkan elemen jika cocok
                    } else {
                        $(this).hide(); // Sembunyikan elemen jika tidak cocok
                    }
                });
            });
        });
    </script>

    {{-- script js buat logika fitur pada halaman beranda dashboard mahasiswa, perusahaan dan admin --}}
    <script src="{{ asset('js/dashboard.js') }}"></script>

    <script>
        function showAppliedVacancyDetail(vacancyId) {
            // Example of AJAX call to get the vacancy data
            fetch(`/vacancy/${vacancyId}`)
                .then(response => response.json())
                .then(data => {
                    // Prepare the modal content
                    const modalBody = document.querySelector('#vacancyDetailModal .modal-body');
                    modalBody.innerHTML = `
                <div id="vacancy-detail-card-info" class="apply-form bg-white p-4 d-flex gap-4 mt-3">
                    <div class="position-relative w-50">
                        <h1 class="apply-form-title">${data.title}</h1>
                        <div class="d-flex mt-3">
                            <img class="apply-vacancy-img object-fit-cover object-fit-position me-2" src="{{ asset('${data.company.photo}') }}" alt="Company photo">
                            <div style="width: 250px">
                                <div class="apply-company-title d-flex justify-content-between">
                                    <span class="fw-500" style="width: 100px;">${data.company.name}</span>
                                    <span class="fw-500">${data.location}</span>
                                </div>
                                <div class="apply-vacancy-small-detail d-flex gap-2 mt-1">
                                    <span class="bg-white rounded-pill p-1">${data.time_type}</span>
                                    <span class="bg-white rounded-pill p-1">${data.type}</span>
                                    <span class="bg-white rounded-pill p-1">${data.duration}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-input-container mt-4">
                            <label class="fw-500">Gaji</label>
                            <div class="input-group">
                                <div class="box" style="width: 50px;">${data.salary}</div>
                                <span class="mx-3">/</span>
                                <div class="box" style="width: 30px;">${data.salary === 0 ? "-" : "bulan"}</div>
                            </div>

                            <label class="fw-500">Jurusan</label>
                            <div class="box">${data.major}</div>

                            <label class="fw-500">Dibuka</label>
                            <div class="input-group">
                                <div class="box">${data.date_created}</div>
                                <span class="mx-3">-</span>
                                <div class="box">${data.date_ended}</div>
                            </div>

                            <label class="fw-500">Kuota</label>
                            <div class="box">${data.quota}</div>

                            <label class="fw-500">Pendaftar</label>
                            <div class="box">${data.applied}</div>
                        </div>
                    </div>
                    <div class="w-50">
                        <h5 class="apply-vacancy-detail-lowongan">Detail Lowongan</h5>
                        <div class="apply-vacancy-detail overflow-auto">${data.description}</div>
                    </div>
                </div>    
            `;

                    // Show the modal
                    const modal = new bootstrap.Modal(document.getElementById('vacancyDetailModal'));
                    modal.show();
                })
                .catch(error => {
                    console.error('Error fetching vacancy details:', error);
                });
        }
    </script>

</body>

</html>
