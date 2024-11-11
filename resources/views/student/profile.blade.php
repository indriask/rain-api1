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
    <link rel="stylesheet" href="{{ asset('css/student/profile.css') }}">
    <title>Wasyn Sulaiman Siregar | RAIN</title>
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
        {{-- bagian profile mahasiswa start --}}
        <div class="container bg-white shadow" style="margin-top: 3.5rem; border-radius: 30px; padding: 5rem 3rem 3rem">
            <div class="container-fluid p-0 d-flex justify-content-center" style="column-gap: 8rem;">
                {{-- profile mahasiswa start --}}
                <div class="bg-white">
                    <div class="profile-mahasiswa d-flex gap-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQHLb02-VjrYew8VTF7K4wyY0M7XsMv5mZ3A&s"
                            alt="Wasyn Sulaiman Siregar profile" class="profile-mahasiswa-img rounded shadow">
                        <div>
                            <div>
                                <h3 class="nama-lengkap">Wasyn Sulaiman Siregar</h3>
                                <span class="tipe-profile">Mahasiswa</span>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <ul class="info-tambahan">
                            <h6>Tentang</h6>
                            <li>
                                <span>Asal institusi</span>
                                <span>Politeknik Negeri Batam</span>
                            </li>
                            <li><span>Jurusan</span><span>Teknik Informatika</span></li>
                            <li><span>Program Studi</span><span>TRPL</span></li>
                        </ul>
                        <ul class="info-tambahan">
                            <h6>Alamat</h6>
                            <li><span>Alamat</span><span>Legenda Utara</span></li>
                            <li><span>Kota</span><span>Batam</span></li>
                            <li><span>Kode pos</span><span>12334</span></li>
                        </ul>
                        <ul class="info-tambahan">
                            <h6>Kontak Mahasiswa</h6>
                            <li><span>Kontak mahasiswa</span><span>08123456789</span></li>
                            <li><span>Email</span><span>mahasiswa@politeknik.batam</span></li>
                        </ul>
                    </div>
                    <a href="{{ route('dashboard') }}" style="text-decoration: none;"><button
                            class="kembali-btn border border-0 bg-white rounded-pill">Kembali</button></a>
                </div>
                {{-- profile mahasiswa end --}}


                {{-- deskripsi mahasiswa start --}}
                <div class="bg-white position-relative" style="width: 50%;">
                    <button class="edit-profile ms-auto bg-white position-absolute end-0 rounded-pill"
                        style="top: -3rem" id="daftar" data-bs-toggle="modal"
                        data-bs-target="#edit-profile-modal">Edit
                        profile</button>
                    <h6 class="deskripsi-profile-heading">Deskripsi Profil Mahasiswa</h6>
                    <div class="kotak-deskripsi rounded overflow-auto py-3 px-4">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab nesciunt, velit minus cupiditate
                        quas saepe, temporibus voluptatibus ex, odio iure aut! Quis porro laboriosam laudantium magni
                        cupiditate ad, non ea.
                    </div>
                </div>
                {{-- deskripsi mahasiswa end --}}

                {{-- edit profile modal start --}}
                <div class="modal fade" id="edit-profile-modal" tabindex="-1" aria-labelledby="edit-profile-modal"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile Mahasiswa</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST" class="edit-profile-form">
                                    <h6 class="edit-profile-heading">Tentang</h6>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Profile</label>
                                        <input class="form-control" type="file" name="profile-mahasiswa" id="formFile">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama-lengkp" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama-lengkap" id="nama-lengkap"
                                            placeholder="Nama lengkap" value="Wasyn Sulaiman Siregar">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="deskripsi-diri">Deskripsi diri</label>
                                        <textarea class="form-control" placeholder="Deskripsi diri" id="deskripsi-diri" name="deskripsi-diri" style="height: 150px"></textarea>
                                      </div>
                                    <h6 class="edit-profile-heading mt-4">Alamat</h6>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" id="alamat"
                                            placeholder="Alamat" value="Legenda utara">
                                    </div>
                                    <div class="mb-3">
                                        <label for="kota" class="form-label">Kota</label>
                                        <input type="text" class="form-control" name="kota" id="kota"
                                            placeholder="Kota" value="Batam">
                                    </div>
                                    <div class="mb-3">
                                        <label for="kota-pos" class="form-label">Kota pos</label>
                                        <input type="number" class="form-control" name="kode-pos" id="kode-pos"
                                            placeholder="Kode pos" value="123456">
                                    </div>
                                    <h6 class="edit-profile-heading mt-4">Kontak Mahasiswa</h6>
                                    <div class="mb-3">
                                        <label for="nomor-telepon" class="form-label">Nomor telepon</label>
                                        <input type="number" class="form-control" name="nomor-telepon" id="nomor-telepon"
                                            placeholder="Nomor telepon" value="08123456789">
                                    </div>
                                    <button class="btn btn-dark my-3">Edit profile</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- edit profile modal end --}}
            </div>
        </div>
        {{-- bagian profile mahasiswa end --}}
    </div>
    {{-- dashboard content section end --}}


    {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
