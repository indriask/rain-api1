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
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQE6-KsNGUoKgyIAATW1CNPeVSHhZzS_FN0Zg&s"
                            alt="" class="profile-img rounded-circle shadow">
                        <span class="profile-name">{{ auth()->user()->student->profile->first_name }}
                            {{ auth()->user()->student->profile->last_name }}</span>
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
                    <button class="hapus-filter ms-auto">
                        <i class="bi bi-x-square me-1"></i>
                        Hapus filter
                    </button>
                </div>
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
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbgAzqz4kY3Lte8GPpOfYnINyvZhPxXl5uSw&s"
                                    alt="Company photo">
                            </div>
                            <div>
                                <h6 class="vacancy-role m-0">{{ $vacancy->title }}</h6>
                                <span class="vacancy-major-choice">{{ $vacancy->major_name }}</span>

                                <ul class="vacancy-small-detail p-0 mt-3">
                                    <li><i class="bi bi-geo-alt me-3"></i>{{ $vacancy->location }}</li>
                                    <li><i
                                            class="bi bi-calendar3 me-3"></i>{{ \Carbon\Carbon::parse($vacancy->date_created)->format('d F Y') }}
                                    </li>
                                    <li><i class="bi bi-bar-chart-line me-3"></i>{{ $vacancy->quota }} Kuota</li>
                                </ul>

                                <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                    <li class="bg-white rounded-pill text-center">{{ $vacancy->type }}</li>
                                    <li class="bg-white rounded-pill text-center">{{ $vacancy->time_type }}</li>
                                    <li class="bg-white rounded-pill text-center">{{ $vacancy->duration }}</li>
                                </ul>

                                <button onclick="showVacancyDetailModal('{{ $vacancy->id_vacancy }}')"
                                    class="vacancy-detail border border-0 text-white mx-auto d-block mt">Lihat</button>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            {{-- bagian menampilkan detail lowongan yang dilamar --}}
            <div id="student-applied-vacancy-detail"
                class="d-none pe-none position-absolute vacancy-apply-form top-0 start-0 bottom-0 end-0 d-flex justify-content-center overflow-auto">
                <div class="apply-form bg-white p-4 d-flex gap-4 mt-3">
                    <div class="position-relative w-50">
                        <h1 class="apply-form-title">Frontend Developer</h1>
                        <div class="d-flex mt-3">
                            <img class="apply-vacancy-img object-fit-cover object-fit-position me-2"
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTK3CAhjRZ4esxRs2HBnf9qKoF6PAy4063vvA&s"
                                alt="">
                            <div style="width: 250px">
                                <div class="apply-company-title d-flex justify-content-between">
                                    <span class="fw-500" style="width: 100px;">Perusahaan</span>
                                    <span class="fw-500">Batam, Indonesia</span>
                                </div>
                                <div class="apply-vacancy-small-detail d-flex gap-2 mt-1">
                                    <span class="bg-white rounded-pill p-1">Penuh Waktu</span>
                                    <span class="bg-white rounded-pill p-1">Offline</span>
                                    <span class="bg-white rounded-pill p-1">6 Bulan</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-input-container mt-4">
                            <label class="fw-500">Gaji</label>
                            <div class="input-group">
                                <div class="box" style="width: 50px;">2.500.000</div>
                                <span class="mx-3">/</span>
                                <div class="box" style="width: 30px;"></div>
                            </div>

                            <label class="fw-500">Jurusan</label>
                            <div class="box">Teknik Jaringan komunikasi</div>

                            <label class="fw-500">Dibuka</label>
                            <div class="input-group">
                                <div class="box">23 Sep 2024</div>
                                <span class="mx-3">-</span>
                                <div class="box">23 Sep 2024</div>
                            </div>

                            <label class="fw-500">Kuota</label>
                            <div class="box">30</div>

                            <label class="fw-500">Status</label>
                            <div class="box">Dibuka</div>

                            <label class="fw-500">Pelamar</label>
                            <div class="box">18</div>
                        </div>
                        <div class="position-absolute bottom-0">
                            <button onclick="showVacancyDetailModal()" type="button"
                                class="close-apply-form text-white fw-700 border border-0 me-2">Kembali</button>
                            <button class="close-apply-form border border-0 text-white bni-blue fw-700" type="button"
                                onclick="showStudentVacancyStatus(1)">Cek Status</button>
                        </div>
                    </div>
                    <div class="w-50">
                        <h5 class="apply-vacancy-detail-lowongan">Detail Lowongan</h5>
                        <div class="apply-vacancy-detail overflow-auto">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae itaque nesciunt
                            inventore consectetur obcaecati quas atque a deserunt laudantium! Pariatur ratione eaque
                            enim tenetur est esse quam dignissimos minus eveniet!
                        </div>
                    </div>
                </div>
            </div>

            {{-- check status lamaran mahasiswa --}}
            <div id="applied-vacancy-status">
            </div>

            <div id="apply-status-info">
            </div>

            {{-- pop up notifikasi ingin logout --}}
            <x-logout-card />
        </main>
    </div>

    <!-- Vacancy Detail Modal -->
    <div class="modal fade" id="vacancyDetailModal" tabindex="-1" aria-labelledby="vacancyDetailModalLabel"
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
    </div>


    {{-- script jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS (required for modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
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
    </script>


    {{-- script js buat logika fitur umum pada dashboard mahasiswa, perusahaan dan admin --}}
    <script defer src="{{ asset('js/dashboard.js') }}"></script>

    {{-- script js buat logika fitur dashboard daftar lamaran mahasiswa --}}
    {{-- <script defer src="{{ asset('js/student/daftar-lamaran.js') }}"></script> --}}

    <script>
        function showVacancyDetailModal(vacancyId) {
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
                
                <!-- Lamar Pekerjaan Button -->
                <button class="btn btn-primary mt-4" id="applyButton" ${data.userHasApplied ? 'disabled' : ''}>
                    ${data.userHasApplied ? 'Sudah Dilamar' : 'Lamar Pekerjaan'}
                </button>
    
                <!-- Resume Form -->
                <div id="resumeForm" class="mt-4" style="display:none;">
                    <h5>Unggah Resume</h5>
                    <form id="applyForm" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="resume">Pilih Resume:</label>
                            <input type="file" id="resume" name="resume" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Kirim Lamaran</button>
                    </form>
                </div>
            `;

                    // Show the modal
                    const modal = new bootstrap.Modal(document.getElementById('vacancyDetailModal'));
                    modal.show();

                    // Handle "Lamar Pekerjaan" button click
                    document.getElementById('applyButton').addEventListener('click', function() {
                        document.getElementById('resumeForm').style.display = 'block';
                        document.getElementById('applyButton').style.display = 'none';
                    });

                    // Handle form submission
                    document.getElementById('applyForm').addEventListener('submit', function(e) {
                        e.preventDefault();

                        const formData = new FormData(this);
                        formData.append('vacancy_id', vacancyId);

                        fetch('/apply', {
                                method: 'POST',
                                body: formData,
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Lamaran berhasil dikirim!');
                                    // Close the modal or clear the form if needed
                                    modal.hide();
                                } else {
                                    alert('Gagal mengirim lamaran!');
                                }
                            })
                            .catch(error => {
                                console.error('Error submitting application:', error);
                            });
                    });
                })
                .catch(error => {
                    console.error('Error fetching vacancy details:', error);
                });
        }
    </script>


</body>

</html>
