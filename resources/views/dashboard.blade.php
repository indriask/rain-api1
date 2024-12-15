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

            {{-- vacancy card list --}}
            <div id="card-container" class="overflow-auto">
                <div id="vacancy-card-list-container" class="overflow-auto position-relative h-100">
                    <div id="data-lowongan" class="vacancy-card-list px-3 gap-3 mt-4">
                        {{-- vacancy card --}}
                        @foreach ($lowongan as $lowong)
                            <div class="vacancy-card bg-white py-3 px-4">
                                <div class="d-flex justify-content-between">
                                    <h5 class="salary-text">Rp.
                                        {{ number_format($lowong->gaji_perbulan, 0, ',', '.') }}/bulan
                                    </h5>
                                    <img class="company-photo rounded"
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbgAzqz4kY3Lte8GPpOfYnINyvZhPxXl5uSw&s"
                                        alt="Company photo">
                                </div>
                                <div>
                                    <h6 class="vacancy-role m-0">{{ $lowong->nama_pekerjaan }}</h6>
                                    <span class="vacancy-major-choice">{{ $lowong->jurusan->name }}</span>

                                    <ul class="vacancy-small-detail p-0 mt-3">
                                        <li><i class="bi bi-geo-alt me-3"></i>{{ $lowong->lokasi }}</li>
                                        <li><i
                                                class="bi bi-calendar3 me-3"></i>{{ \Carbon\Carbon::parse($lowong->tanggal_pendaftaran)->format('d-F-Y') }}

                                        </li>
                                        <li><i class="bi bi-bar-chart-line me-3"></i>{{ $lowong->jumlah_kouta }} Kuota
                                        </li>
                                    </ul>

                                    <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                        <li class="bg-white rounded-pill text-center">{{ $lowong->jenis_kerja }}</li>
                                        <li class="bg-white rounded-pill text-center">{{ $lowong->mode_kerja }}</li>
                                        <li class="bg-white rounded-pill text-center">{{ $lowong->lama_magang }} Bulan
                                        </li>
                                    </ul>

                                    <button onclick="showVacancyDetail('1')"
                                        class="vacancy-detail border border-0 text-white mx-auto d-block mt">Detail</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- vacancy detail card --}}
            <div id="vacancy-detail-card"
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
                                <div class="box" style="width: 30px;">hari</div>
                            </div>

                            <label class="fw-500">Jurusan</label>
                            <div class="box">Manajemen Bisnis</div>

                            <label class="fw-500">Dibuka</label>
                            <div class="input-group">
                                <div class="box">30 Okt 2023</div>
                                <span class="mx-3">-</span>
                                <div class="box">10 Okt 2025</div>
                            </div>

                            <label class="fw-500">Kuota</label>
                            <div class="box">5</div>

                            <label class="fw-500">Status</label>
                            <div class="box">Buka</div>

                            <label class="fw-500">Pendaftar</label>
                            <div class="box">2</div>
                        </div>
                        <div class="position-absolute bottom-0">
                            <button onclick="closeVacancyDetail()" type="button"
                                class="close-apply-form text-white fw-700 border border-0">Kembali</button>
                        </div>
                    </div>
                    <div class="w-50">
                        @if ($role === 'student')
                            <div class="d-flex">
                                <button type="button"
                                    class="apply-vacancy-button border border-0 text-white fw-700 ms-auto"
                                    onclick="showApplyVacancyFormContainer(1)">Daftar</button>
                            </div>
                        @endif
                        <h5 class="apply-vacancy-detail-lowongan">Detail Lowongan</h5>
                        <div class="apply-vacancy-detail overflow-auto">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae itaque nesciunt
                            inventore consectetur obcaecati quas atque a deserunt laudantium! Pariatur ratione eaque
                            enim tenetur est esse quam dignissimos minus eveniet!
                        </div>
                    </div>
                </div>
            </div>

            {{-- vacancy apply form --}}
            <div id="vacancy-apply-form-container"
                class="d-none pe-none vacancy-apply-form-container position-absolute top-0 start-0 bottom-0 end-0 d-flex justify-content-center align-items-center flex-column py-4">

                {{-- vacancy apply form input --}}
                <form id="vacancy-apply-form" action="{{ route('api-student-apply-vacancy') }}" method="POST"
                    class="vacancy-apply-form-card bg-white p-4">
                    <div class="d-flex justify-content-between">
                        <h1 class="vacancy-apply-form-card-title fw-700 mb-0">Formulir Lamaran</h1>
                        <button type="button" class="border border-0 bg-transparent"
                            onclick="closeApplyVacancyFormContainer()"><i class="bi bi-x-circle"></i></button>
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
                    <input type="file" name="files" multiple id="upload-file" hidden>

                    {{-- this button will send a request to an api, and will return boolean condition which determine success or not --}}
                    <button type="button" onclick="processAddProposal(1)"
                        class="apply-form-common-info-btn border border-0 text-white fw-700 d-block mx-auto mt-2 text-center">Kirim</button>
                </form>

                {{-- apply form notification --}}
                <div id="apply-form-notification" class="d-none pe-none vacancy-apply-form-card bg-white p-5 rounded">
                    <div class="d-flex align-items-center justify-content-center flex-column">
                        {{-- success message --}}
                        <img class="apply-form-icon ratio-1x1" src="{{ asset('storage/svg/success-checkmark.svg') }}"
                            alt="Success checkmar">
                        <span>Lamaran berhasil di kirim!</span>

                        {{-- failed message --}}
                        {{-- <img src="{{ asset("storage/svg/failed-x.svg") }}" class="apply-form-icon ratio-1x1" alt="Failed Icon">
                        <span>Lamaran gagal di kirim {{ ":(" }}</span> --}}

                        <button onclick="closeAllFormCard()" class="bni-blue border border-0 text-white mt-5 rounded"
                            style="width: 100px; padding: 5px;">Kembali</button>
                    </div>
                </div>
            </div>

            {{-- pop up notifikasi ingin logout --}}
            <x-logout-card />

            {{-- tambah lowongan untuk perusahaan --}}
            <x-add-vacancy />

        </main>
    </div>

    <script defer src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ambil daftar jurusan dari server
            $.getJSON('/jurusan', function(data) {
                let jurusanSelect = $('#jurusan');
                jurusanSelect.empty().append('<option value="">Pilih jurusan</option>');
                data.forEach(function(jurusan) {
                    jurusanSelect.append(`<option value="${jurusan.id}">${jurusan.name}</option>`);
                });
            });

            // Ketika jurusan dipilih, ambil daftar prodi
            $('#jurusan').on('change', function() {
                let idJurusan = $(this).val();
                let prodiSelect = $('#prodi');
                prodiSelect.empty().append('<option value="">Pilih prodi</option>');
                if (idJurusan) {
                    $.getJSON(`/prodi/${idJurusan}`, function(data) {
                        data.forEach(function(prodi) {
                            prodiSelect.append(
                                `<option value="${prodi.id}">${prodi.name}</option>`);
                        });
                    });
                }
            });

            $.getJSON('/lokasi', function(data) {
                let lokasiSelect = $('#lokasi');
                lokasiSelect.empty().append('<option value="">Pilih Lokasi</option>');
                data.forEach(function(lokasi) {
                    lokasiSelect.append(
                        `<option value="${lokasi.lokasi}">${lokasi.lokasi}</option>`);
                });
            });

        });

        function fetchLowongan() {
            const jurusan = $('#jurusan').val();
            const prodi = $('#prodi').val();
            const modeKerja = $('select[name="mode_kerja"]').val();
            const lokasi = $('#lokasi').val();
            const search = $('input[name="cari-perusahaan"]').val();

            $.ajax({
                url: '/lowongan/filter',
                method: 'GET',
                data: {
                    jurusan,
                    prodi,
                    mode_kerja: modeKerja,
                    lokasi,
                    search,
                },
                success: function(data) {
                    const container = $('#data-lowongan');
                    container.empty();
                    data.forEach((lowong) => {
                        // Memformat tanggal
                        const tanggal = new Date(lowong.tanggal_pendaftaran);
                        const bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
                            "Agustus", "September", "Oktober", "November", "Desember"
                        ];
                        const tanggalFormat = ("0" + tanggal.getDate()).slice(-2) + "-" + bulan[tanggal
                            .getMonth()] + "-" + tanggal.getFullYear();

                        container.append(`
            <div class="vacancy-card bg-white py-3 px-4">
                <div class="d-flex justify-content-between">
                    <h5 class="salary-text">Rp. ${lowong.gaji_perbulan.toLocaleString('id-ID')}/bulan</h5>
                    <img class="company-photo rounded" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbgAzqz4kY3Lte8GPpOfYnINyvZhPxXl5uSw&s" alt="Company photo">
                </div>
                <div>
                    <h6 class="vacancy-role m-0">${lowong.nama_pekerjaan}</h6>
                    <span class="vacancy-major-choice">${lowong.jurusan.name}</span>
                    <ul class="vacancy-small-detail p-0 mt-3">
                        <li><i class="bi bi-geo-alt me-3"></i>${lowong.lokasi}</li>
                        <li><i class="bi bi-calendar3 me-3"></i>${tanggalFormat}</li> <!-- Tanggal yang diformat -->
                        <li><i class="bi bi-bar-chart-line me-3"></i>${lowong.jumlah_kouta} Kuota</li>
                    </ul>
                    <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                        <li class="bg-white rounded-pill text-center">${lowong.jenis_kerja}</li>
                        <li class="bg-white rounded-pill text-center">${lowong.mode_kerja}</li>
                        <li class="bg-white rounded-pill text-center">${lowong.lama_magang} Bulan</li>
                    </ul>
                    <button onclick="showVacancyDetail('1')"
                        class="vacancy-detail border border-0 text-white mx-auto d-block mt">Detail</button>
                </div>
            </div>
        `);
                    });
                },

            });
        }

        $('#jurusan, #prodi, select[name="mode_kerja"], #lokasi, input[name="cari-perusahaan"]').on('change keyup',
            fetchLowongan);

        $('.hapus-filter').on('click', function() {
            $('#jurusan').val('');
            $('#prodi').val('');
            $('#prodi').find('option').not(':first').remove();
            $('select[name="mode_kerja"]').val('');
            $('#lokasi').val('');
            $('input[name="cari-perusahaan"]').val('');
            fetchLowongan();
        });
    </script>


</body>

</html>
