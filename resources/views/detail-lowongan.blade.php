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

    {{-- tailwing css link --}}

    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('css/detail-lowongan.css') }}">

    <title>{{ $lowongan }} | RAIN</title>
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
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZdwNBiQboKdExrMOqOu0HfTcF1ljCPs3ZtQ&s"
                alt="Your profile" class="nav-profile rounded-pill shadow">
        </div>
    </nav>
    {{-- navbar section end --}}

    {{-- dashboard content section start --}}
    <div class="dashboard-content-container container-fluid bg-white p-3">

        {{-- detail lowongan magang section start --}}
        <div class="container bg-white shadow" style="margin-top: 3.5rem; border-radius: 30px; padding: 5rem 3rem;">
            <div class="container-fluid p-0 d-flex justify-content-center" style="column-gap: 5rem;">
                <div class="bg-white">
                    <h3 class="detail-title mb-4">{{ $lowongan }}</h3>
                    <div class="detail-profile d-flex gap-2">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQHLb02-VjrYew8VTF7K4wyY0M7XsMv5mZ3A&s"
                            alt="Detail lowongan" class="rounded flex-shrink-0">
                        <div>
                            <div class="d-flex align-items-center gap-5">
                                <span>Perusahaan</span>
                                <span>Batam, Indonesia</span>
                            </div>
                            <div class="d-flex gap-2">
                                <p class="rounded bg-white">Penuh Waktu</p>
                                <p class="rounded bg-white">Kantor</p>
                                <p class="rounded bg-white">6 Bulan</p>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <table class="detail-information-table">
                            <tr>
                                <td style="width: 100px">Gaji</td>
                                <td class="detail-information-box">2.500.000</td>
                                <td style="padding-inline: 1rem;">/</td>
                                <td>bulan</td>
                            </tr>
                            <tr>
                                <td style="width: 100px">Jurusan</td>
                                <td class="detail-information-box">Teknik Informatika</td>
                            </tr>
                            <tr>
                                <td style="width: 100px">Tanggal</td>
                                <td class="detail-information-box">20 September 2024</td>
                            </tr>
                            <tr>
                                <td style="width: 100px">Kuota</td>
                                <td class="detail-information-box">30 Kuota</td>
                            </tr>
                            <tr>
                                <td style="width: 100px">Tempat</td>
                                <td class="detail-information-box">Batam, Indonesia</td>
                            </tr>
                        </table>
                    </div>

                    <a href="{{ route('dashboard') }}" style="text-decoration: none;"><button
                            class="kembali-btn border border-0 bg-white rounded-pill">Kembali</button></a>
                </div>
                <div class="bg-white position-relative" style="width: 50%;">
                    <button class="daftar-lowongan ms-auto bg-white position-absolute end-0 rounded" style="top: -3rem"
                        id="daftar" onclick="displayFormLamaran()">Daftar</button>
                    <h6 class="deskripsi-lowongan-heading">Detail Lowongan</h6>
                    <div class="kotak-deskripsi rounded overflow-hidden py-3 px-4">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium quis dolorem et rerum
                        laudantium veritatis! Placeat id doloribus cupiditate corrupti ut deleniti sapiente nostrum,
                        labore quae. Aliquam quae laboriosam omnis sequi vel molestias voluptatibus minus suscipit
                        beatae autem, quia totam? Nihil, mollitia possimus. Blanditiis delectus hic nesciunt temporibus
                        voluptatibus! Ipsum!
                    </div>
                </div>
            </div>
        </div>
        {{-- detail lowongan magang section end --}}

        {{-- formulir lamaran section start --}}
        <div class="position-absolute start-0 top-0 end-0 bottom-0 d-none pe-none align-items-center justify-content-center"
            id="form-lamaran">
            <div class="formulir-container bg-white shadow py-3 px-5">
                <div class="close-form-lamaran-btn">
                    <button class="border border-0 float-end bg-transparent" onclick="closeFormLamaran()"><i
                            class="bi bi-x"></i></button>
                </div>
                <div class="mb-5">
                    <h4 class="formulir-lamaran-heading">Formulir Lamaran</h4>
                    <p class="formulir-lamaran-small-text">Silahkan mengisi formulir dibawah sesuai dengan ketentuan
                    </p>
                </div>
                <form action="" method="POST" class="position-relative">
                    <div class="" id="formulir-lamaran-input-container">
                        <h5 class="formulir-lamaran-heading">Informasi dasar</h5>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="nama-lengkap" name="nama-lengkap"
                                placeholder="Nama lengkap">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="nim" name="nim"
                                placeholder="NIM">
                        </div>
                        <select class="form-select mb-3" name="jurusan" aria-label="Jurusan">
                            <option selected>Jurusan</option>
                            <option value="teknik-informatika">Teknik Informatika</option>
                            <option value="manajemen-bisnis">Manajemen & Bisnis</option>
                            <option value="teknik-elektro">Teknik Elektro</option>
                            <option value="teknik-mesin">Teknik Mesin</option>
                        </select>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="prodi" name="prodi"
                                placeholder="Program studi">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email">
                        </div>
                        <div class="mb-5">
                            <input type="number" class="form-control" id="nomor-telepon" name="nomor-telepon"
                                placeholder="Nomor Telepon">
                        </div>

                        <h5 class="formulir-lamaran-heading">Informasi tambahan</h5>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="formulir-lamaran-small-text">Dapat berupa CV atau dokumen lainnya</p>
                            <p class="formulir-lamaran-small-text">Maks. 6 Dokumen</p>
                        </div>
                        <div>
                            <label class="input-file bg-white w-100 rounded p-2 text-center" for="file"><i
                                    class="bi bi-plus"></i> Tambahkan file</label>
                            <input type="file" class="d-none" name="file" id="file" multiple>
                        </div>
                        <button
                            class="formulir-laporan-btn bg-white rounded mx-auto d-block mt-3" id="form-lamaran-kirim" onclick="displaySuccessMessage()">Kirim</button>
                    </div>
                    <div
                        class="form-lamaran-success position-absolute start-0 top-0 end-0 bottom-0 d-none pe-none">
                        <div>Lamaran telah di kirim.</div>
                        <button class="form-kembali-btn bg-white rounded border border-0" onclick="closeForm()">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- formulir lamaran section end --}}

    </div>
    {{-- dashboard content section end --}}

    <script defer>
        const formLamaran = document.querySelector("#form-lamaran");
        const formLamaranKirimBtn = document.querySelector("#form-lamaran-kirim");
        const formulirLamaranInputContainer = document.querySelector("#formulir-lamaran-input-container");
        const formulirLamaranSuccess = document.querySelector(".form-lamaran-success");

        function displayFormLamaran() {
            formLamaran.classList.remove("d-none", "pe-none");
            formLamaran.classList.add("d-flex");
        }

        function closeFormLamaran() {
            formLamaran.classList.remove("d-flex");
            formLamaran.classList.add("d-none", "pe-none");
        }

        function displaySuccessMessage() {
            formulirLamaranInputContainer.classList.add("invisible", "pe-none");
            formulirLamaranSuccess.classList.remove("d-none", "pe-none");
        }

        function closeSuccessMessage() {
            formulirLamaranInputContainer.classList.remove("invisible", "pe-none");
            formulirLamaranSuccess.classList.add("d-none", "pe-none");
        }

        function closeForm() {
            closeSuccessMessage();
            closeFormLamaran();
        }
    </script>
</body>

</html>
