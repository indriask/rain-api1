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
                class="d-none vacancy-apply-form-container position-absolute top-0 start-0 bottom-0 end-0 d-flex align-items-center flex-column py-4 overflow-auto">

                {{-- form input isi data diri mahasiswa --}}
                <div id="vacancy-apply-form">
                </div>

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
                        onclick="showCustomNotification()">Tutup</button>
                </div>
            </div>

            {{-- pop up notifikasi ingin logout --}}
            <x-logout-card />

            {{-- tambah lowongan untuk perusahaan, hanya muncul jika role user adalah company --}}
            <div id="add-vacancy"></div>
        </main>
    </div>

    {{-- script jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- script js buat logika fitur pada halaman beranda dashboard mahasiswa, perusahaan dan admin --}}
    <script src="{{ asset('js/dashboard.js') }}"></script>

</body>

</html>
