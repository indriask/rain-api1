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

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <title>Daftar Lamaran | RAIN</title>
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
        <main class="dashboard-main position-relative" id="dashboard-main">
            {{-- user profile and filter input --}}
            <div class="dashboard-main-nav border-bottom border-black px-5 py-3">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center gap-1 mb-2">
                        <img src="{{ asset('storage/' . $user->$role->profile->photo_profile) }}" alt=""
                            class="profile-img rounded-circle shadow">
                        <span class="profile-name">{{ $fullName }}</span>
                    </div>
                    {{-- <div class="position-relative">
                        <input type="text" id="search-lowongan"
                            class="search-company bg-white border border-0 focus-ring shadow"
                            placeholder="Cari berdasarkan judul lowongan">
                        <i class="bi bi-search search-icon"></i>
                    </div> --}}
                </div>
                {{-- <div class="select-container w-100 mt-2 d-flex gap-3">
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
                    <button class="hapus-filter ms-auto">
                        <i class="bi bi-x-square me-1"></i>
                        Hapus filter
                    </button>
                </div> --}}
            </div>

            {{-- bagian menampilkan semua lowngan yang dilamar --}}
            <div id="vacancy-card-list-container" class="overflow-auto position-relative h-100">
                <div id="data-lowongan" class="vacancy-card-list px-3 gap-3 mt-4">
                    {{-- Iterasi data vacancies --}}
                    @foreach ($vacancies as $vacancy)
                        <div class="vacancy-card bg-white py-3 px-4">
                            <div class="d-flex justify-content-between">
                                <h5 class="salary-text">Rp. {{ number_format($vacancy->salary, 0, ',', '.') }}/bulan
                                </h5>
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
                                    <li class="bg-white rounded-pill text-center">{{ $vacancy->vacancy_type }}</li>
                                    <li class="bg-white rounded-pill text-center">{{ $vacancy->time_type }}</li>
                                    <li class="bg-white rounded-pill text-center">{{ $vacancy->duration }} Bulan</li>
                                </ul>

                                <button onclick="showAppliedVacancyDetail('{{ $vacancy->id_proposal }}')"
                                    class="vacancy-detail border border-0 text-white mx-auto d-block click-animation">Lihat</button>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- menampilkan detail lowongan yang dilamar --}}
            <div id="student-applied-vacancy-detail"
                class="d-none position-absolute vacancy-apply-form top-0 start-0 bottom-0 end-0 d-flex justify-content-center overflow-auto">
            </div>

            {{-- check status lamaran mahasiswa --}}
            <div id="applied-vacancy-status">
            </div>

            {{-- pilih opsi ccheck status --}}
            <div id="apply-status-info">
            </div>

            {{-- pop up notifikasi custom --}}
            <div id="custom-notification"
                class="d-none position-absolute top-0 end-0 bottom-0 start-0 d-flex align-items-center justify-content-center"
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
        </main>
    </div>

    {{-- script jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- script js fitur dashboard mahasiswa, perusahaan dan admins --}}
    {{-- <script src="{{ asset('js/dashboard.js') }}"></script> --}}

    {{-- script js fitu daftar lamaran mahasiswa --}}
    <script src="{{ asset('js/student/daftar-lamaran.js') }}"></script>

    {{-- <script>
        $(document).ready(function() {
            // Event listener ketika select lowongan berubah
            $('#mode_kerja').on('change', function() {
                const selectedTitle = $(this).val(); // Ambil lowongan yang dipilih

                // Lakukan request ke backend dengan lowongan yang dipilih
                $.ajax({
                    url: '/filter-vacancies-by-title', // URL endpoint untuk filter
                    type: 'GET',
                    data: {
                        title: selectedTitle
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
                                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTK3CAhjRZ4esxRs2HBnf9qKoF6PAy4063vvA&s"
                                                alt="Company photo">
                                        </div>
                                        <div>
                                            <h6 class="vacancy-role m-0">${vacancy.title}</h6>
                                            <span class="vacancy-major-choice">${vacancy.major_name}</span>
                                            <ul class="vacancy-small-detail p-0 mt-3">
                                                <li><i class="bi bi-geo-alt me-3"></i>${vacancy.location}</li>
                                                <li><i class="bi bi-calendar3 me-3"></i>${new Date(vacancy.date_created).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</li>
                                                <li><i class="bi bi-bar-chart-line me-3"></i>${vacancy.quota} Kuota</li>
                                            </ul>
                                            <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                                <li class="bg-white rounded-pill text-center">${vacancy.type}</li>
                                                <li class="bg-white rounded-pill text-center">${vacancy.time_type}</li>
                                                <li class="bg-white rounded-pill text-center">${vacancy.duration}</li>
                                            </ul>
                                            <button onclick="showVacancyDetailModal('${vacancy.id_vacancy}')"
                                                class="vacancy-detail border border-0 text-white mx-auto d-block mt">Lihat</button>
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
                                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTK3CAhjRZ4esxRs2HBnf9qKoF6PAy4063vvA&s"
                                                alt="Company photo">
                                        </div>
                                        <div>
                                            <h6 class="vacancy-role m-0">${vacancy.title}</h6>
                                            <span class="vacancy-major-choice">${vacancy.major_name}</span>
                                            <ul class="vacancy-small-detail p-0 mt-3">
                                                <li><i class="bi bi-geo-alt me-3"></i>${vacancy.location}</li>
                                                <li><i class="bi bi-calendar3 me-3"></i>${new Date(vacancy.date_created).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</li>
                                                <li><i class="bi bi-bar-chart-line me-3"></i>${vacancy.quota} Kuota</li>
                                            </ul>
                                            <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                                <li class="bg-white rounded-pill text-center">${vacancy.type}</li>
                                                <li class="bg-white rounded-pill text-center">${vacancy.time_type}</li>
                                                <li class="bg-white rounded-pill text-center">${vacancy.duration}</li>
                                            </ul>
                                            <button onclick="showVacancyDetailModal('${vacancy.id_vacancy}')"
                                                class="vacancy-detail border border-0 text-white mx-auto d-block mt">Lihat</button>
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
                                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTK3CAhjRZ4esxRs2HBnf9qKoF6PAy4063vvA&s"
                                            alt="Company photo">
                                    </div>
                                    <div>
                                        <h6 class="vacancy-role m-0">${vacancy.title}</h6>
                                        <span class="vacancy-major-choice">${vacancy.major_name}</span>
                                        <ul class="vacancy-small-detail p-0 mt-3">
                                            <li><i class="bi bi-geo-alt me-3"></i>${vacancy.location}</li>
                                            <li><i class="bi bi-calendar3 me-3"></i>${new Date(vacancy.date_created).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</li>
                                            <li><i class="bi bi-bar-chart-line me-3"></i>${vacancy.quota} Kuota</li>
                                        </ul>
                                        <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                            <li class="bg-white rounded-pill text-center">${vacancy.type}</li>
                                            <li class="bg-white rounded-pill text-center">${vacancy.time_type}</li>
                                            <li class="bg-white rounded-pill text-center">${vacancy.duration}</li>
                                        </ul>
                                        <button onclick="showVacancyDetailModal('${vacancy.id_vacancy}')"
                                            class="vacancy-detail border border-0 text-white mx-auto d-block mt">Lihat</button>
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
                                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTK3CAhjRZ4esxRs2HBnf9qKoF6PAy4063vvA&s"
                                            alt="Company photo">
                                    </div>
                                    <div>
                                        <h6 class="vacancy-role m-0">${vacancy.title}</h6>
                                        <span class="vacancy-major-choice">${vacancy.major_name}</span>
                                        <ul class="vacancy-small-detail p-0 mt-3">
                                            <li><i class="bi bi-geo-alt me-3"></i>${vacancy.location}</li>
                                            <li><i class="bi bi-calendar3 me-3"></i>${new Date(vacancy.date_created).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</li>
                                            <li><i class="bi bi-bar-chart-line me-3"></i>${vacancy.quota} Kuota</li>
                                        </ul>
                                        <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                            <li class="bg-white rounded-pill text-center">${vacancy.type}</li>
                                            <li class="bg-white rounded-pill text-center">${vacancy.time_type}</li>
                                            <li class="bg-white rounded-pill text-center">${vacancy.duration}</li>
                                        </ul>
                                        <button onclick="showVacancyDetailModal('${vacancy.id_vacancy}')"
                                            class="vacancy-detail border border-0 text-white mx-auto d-block mt">Lihat</button>
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
    </script> --}}

</body>

</html>
