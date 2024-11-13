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
    <link rel="stylesheet" href="{{ asset('css/company/pasang-lowongan.css') }}">
    <title>PT. Suka Maju Indonesia | RAIN</title>
</head>

<body class="position-relative">

    {{-- navbar section start --}}
    <nav class="navbar fixed-top p-0 bg-white">
        <div class="container p-0">
            <div onclick="window.location.href='{{ route('welcome') }}'" style="cursor: pointer">
                <a href="{{ route('welcome') }}">
                    <img src="{{ asset('storage/2d-logo.png') }}" class="rain-logo" alt="RAIN logo">
                </a>
                <span class="logo-title">RAIN</span>
            </div>
            <div class="custom-nav-list">
                <a href="{{ route('dashboard') }}">Beranda</a>
                <a href="{{ route('pasang-lowongan') }}">Pasang Lowongan</a>
            </div>

            {{-- 
                lakukan pengecekan apakah user merupakan mahasiswa atau perusahaan ketika user
                masuk ke bagian profile
            --}}
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZdwNBiQboKdExrMOqOu0HfTcF1ljCPs3ZtQ&s"
                alt="Your profile" class="nav-profile rounded-pill shadow">
        </div>
    </nav>
    {{-- navbar section end --}}

    {{-- dashboard content section start --}}
    <div class="dashboard-content-container container-fluid bg-white p-3">
        {{-- bagian profile mahasiswa start --}}
        <form action="" method="POST">
            <div class="container bg-white shadow"
                style="margin-top: 3.5rem; border-radius: 30px; padding: 3rem;">
                <div class="container-fluid p-0 d-flex justify-content-center" style="column-gap: 5rem;">

                    {{-- profile perusahaan start --}}
                    <div class="bg-white">
                        <div class="my-4">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="gaji" style="width: 100px;">Gaji</label>
                                    <input type="text" name="gaji"
                                        class="detail-information-box rounded border border-0" id="gaji">
                                    <span style="padding-inline: .5rem;">/</span>
                                    <input type="text" name="tipe-gaji"
                                        class="detail-information-box rounded border border-0" id="tipe-gaji"
                                        style="width: 100px;">
                                </div>
                                <div class="mb-3">
                                    <label for="judul" style="width: 100px;">Judul</label>
                                    <input type="text" name="judul"
                                        class="detail-information-box rounded border border-0" id="judul">
                                </div>
                                <div class="mb-3">
                                    <label for="jurusan" style="width: 100px;">Jurusan</label>
                                    <input type="text" name="jurusan"
                                        class="detail-information-box rounded border border-0" id="jurusan">
                                </div>
                                <div class="mb-3">
                                    <label for="lokasi" style="width: 100px;">Lokasi</label>
                                    <input type="text" name="lokasi"
                                        class="detail-information-box rounded border border-0" id="lokasi">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" style="width: 100px;">Tanggal</label>
                                    <input type="date" name="tanggal"
                                        class="detail-information-box rounded border border-0" id="tanggal">
                                </div>
                                <div class="mb-3">
                                    <label for="kuota" style="width: 100px;">Kuota</label>
                                    <input type="number" name="kuota"
                                        class="detail-information-box rounded border border-0" id="kuota">
                                </div>
                                <div class="mb-3">
                                    <label for="tipe-waktu" class="align-top"
                                        style="width: 100px; display: inline-block;">Tipe waktu</label>
                                    <div style="display: inline-block">
                                        <div>
                                            <input type="radio" name="tipe-waktu" value="penuh waktu"
                                                id="tipe-waktu">
                                            Penuh waktu
                                        </div>
                                        <div>
                                            <input type="radio" name="tipe-waktu" value="Paruh waktu"
                                                id="tipe-waktu">
                                            Paruh waktu
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis" style="width: 100px;">Jenis</label>
                                    <input type="text" name="jenis"
                                        class="detail-information-box rounded border border-0" id="jenis">
                                </div>
                                <div class="mb-3">
                                    <label for="durasi" style="width: 100px;">Durasi</label>
                                    <input type="text" name="durasi"
                                        class="detail-information-box rounded border border-0" id="durasi">
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- profile perusahaan end --}}

                    {{-- deskripsi perusahaan start --}}
                    <div class="bg-white position-relative" style="width: 50%;">
                        <h6 class="deskripsi-profile-heading">Detail lowongan</h6>
                        <textarea name="detail-lowongan" class="kotak-deskripsi rounded overflow-auto py-3 px-4 border border-0"></textarea>
                    </div>
                    {{-- deskripsi perusahaan end --}}
                </div>

                {{-- bagian button berikutnya dan kembali section start --}}
                <div class="mt-4 d-flex align-items-center justify-content-between">
                    <a href="{{ route('dashboard') }}" style="text-decoration: none;"><button
                            class="kembali-btn border border-0 bg-white rounded-pill">Kembali</button></a>
                    <button onclick="nextFormInput()"
                        class="kembali-btn border border-0 bg-white rounded-pill">Berikutnya</button>
                </div>
                {{-- bagian button berikutnya dan kembali section end --}}

            </div>
        </form>
        {{-- bagian profile mahasiswa end --}}
    </div>
    {{-- dashboard content section end --}}


    {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
