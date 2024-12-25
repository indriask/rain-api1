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
    <link rel="stylesheet" href="{{ asset('css/daftar-pelamar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <title>Daftar Pelamar | RAIN</title>
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
                            <option>Pilih jurusan</option>
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    <div class="select-container">
                        <select name="prodi" id="prodi">
                            <option>Pilih prodi</option>
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    <div class="select-container">
                        <select name="mode_kerja" id="mode_kerja">
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

            {{-- daftar pelamar pada lowongan --}}
            <div id="card-container" class="overflow-auto">
                <div id="proposal-list-container" class="overflow-auto position-relative h-100">
                    <div class="daftar-pelamar__proposal-card-list px-3 gap-3 mt-4">
                        @for ($i = 1; $i <= 7; $i++)
                            <div class="daftar-pelamar__proposal-card bg-white p-4 position-relative">
                                <div onclick="showStudentProfile({{ $i }})" class="cursor-pointer">
                                    <div class="d-flex align-items-center gap-3 border-bottom border-black pb-2">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHr74Pjdj__bQPnZK-BFujbwgnP1t5PIqkig&s"
                                            class="daftar-pelamar__proposal-card-profile rounded-pill" alt="">
                                        <div class="d-flex flex-column">
                                            <span class="daftar-pelamar__proposal-card-name fw-700"
                                                style="font-size: .95rem" title="">Wasyn Sulaiman Siregar</span>
                                            <span class="daftar-pelamar__proposal-card-name" style="font-size: .85rem;"
                                                title="">wasynsulaiman@laravel.com</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <span class="daftar-pelamar__proposal-card-name fw-600"
                                            style="font-size: .95rem">Frontend Developer</span>
                                        <span><i class="bi bi-folder fw-500" style="font-size: .85rem;"></i> 4</span>
                                    </div>
                                </div>
                                <button type="button" onclick="showDeleteApplicant({{ $i }})"
                                    class="daftar-pelamar__proposal-card-delete border border-0 cursor-pointer position-absolute top-0 end-0 bni-blue text-white">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            {{-- profile pelamar mahasiswa --}}
            <div id="daftar-pelamar-student-profile"
                class="d-none position-absolute top-0 end-0 bottom-0 start-0 d-flex justify-content-center"
                style="background-color: rgba(0, 0, 0, .4)">
                <div class="daftar-pelamar__student-profile bg-white p-4 d-flex gap-5 mt-3">
                    <div class="profile-info w-50 position-relative">
                        <div class="d-flex align-items-center gap-3">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQE6-KsNGUoKgyIAATW1CNPeVSHhZzS_FN0Zg&s"
                                alt="Someone profile" class="profile__profile-img rounded">
                            <div class="w-100">
                                <div class="profile__profile-nama-lengkap bg-white rounded p-2">Wasyn Sulaiman Siregar
                                </div>
                                <span class="fw-700" style="font-size: .9rem">Mahasiswa</span>
                            </div>
                        </div>
                        <div class="profile__profile-more-info mt-4">
                            <label for="asal-institusi" style="font-size: .95rem">Asal institusi</label>
                            <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">Politeknik
                                Negeri Batam</div>

                            <label for="jurusan" style="font-size: .95rem">Jurusan</label>
                            <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">Teknik
                                Informatika
                            </div>

                            <label for="program-studi" style="font-size: .95rem">Program studi</label>
                            <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">Teknologi
                                Rekayasa Perangkat Lunak
                            </div>

                            <label for="keahlian" style="font-size: .95rem">Keahlian</label>
                            <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">Hack
                                Webiste NASA</div>

                            <label for="alamat" style="font-size: .95rem">Alamat</label>
                            <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">Batam,
                                Nongsa
                            </div>

                            <label for="kota" style="font-size: .95rem">Kota</label>
                            <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">Kota Batam
                            </div>

                            <label for="kode-pos" style="font-size: .95rem">Kode Pos</label>
                            <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">12345
                            </div>

                            <label for="nomor-telepon" style="font-size: .95rem">Nomor telepon</label>
                            <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">
                                081234567890
                            </div>

                            <label for="email" style="font-size: .95rem">Email</label>
                            <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">
                                eric@laravel.com
                            </div>
                        </div>
                        <div class="position-absolute" style="bottom: 10px;">
                            <button class="border border-0 bni-blue text-white fw-700 p-1 rounded me-2"
                                style="font-size: .9rem; width: 100px;" onclick="showStudentProfile()">Tutup</button>
                            <button class="border border-0 bni-blue text-white fw-700 p-1 rounded"
                                style="font-size: .9rem; width: 130px;" onclick="showStudentProposal('1')">Lihat
                                Lamaran</button>
                        </div>
                    </div>
                    <div class="profile__profile-description w-50">
                        <div class="h-100">
                            <span class="fw-700 mb-2 d-block" style="font-size: .9rem">Deskripsi Profil
                                Mahasiswa</span>
                            <div class="bg-white shadow overflow-auto px-3 py-2"
                                style="font-size: .9rem; height: 435px; text-align: justify; line-height: 1.5rem; border-radius: 20px;">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nisi perferendis in soluta
                                illum
                                delectus eos possimus aspernatur, ea placeat ad voluptates inventore non temporibus
                                expedita
                                ratione quae consequuntur quod obcaecati? Quo, asperiores inventore! Error
                                exercitationem
                                delectus eaque iure ipsum numquam repudiandae placeat rem aliquam, quisquam, porro at!
                                Ad
                                quaerat ducimus tempora earum porro similique velit illum hic esse, consectetur aliquid
                                provident voluptate eligendi harum, odio eveniet, rerum consequuntur. Facere,
                                perspiciatis
                                pariatur? Dolore debitis aliquid eius nobis deserunt sint accusantium fugit illo
                                impedit,
                                optio sit consequuntur laboriosam inventore dolores quo sequi dolorem necessitatibus?
                                Repellat assumenda voluptate unde. Ipsa nihil eligendi maiores!
                            </div>
                        </div>
                    </div>
                </div>

                {{-- informasi proposal pelamar --}}
                <div id="daftar-pelamar-proposal-info-container"
                    class="d-none vacancy-apply-form-container position-absolute top-0 start-0 bottom-0 end-0 d-flex justify-content-center align-items-center flex-column py-4">
                    <div id="daftar-pelamar-proposal-info-box"
                        class="vacancy-apply-form-card bg-white p-4 position-relative">
                        <div class="position-absolute top-0 end-0">
                            <button class="daftar-pelamar__proposal-info-close text-white border border-0 bni-blue"
                                onclick="showStudentProposal()"><i class="bi bi-x-circle"></i></button>
                        </div>

                        <div class="d-flex justify-content-between">
                            <h1 class="vacancy-apply-form-card-title fw-700 mb-0">Informasi Lamaran</h1>
                        </div>

                        <div class="apply-form-common-info mt-4">
                            <h5 class="apply-form-common-info-heading fw-700 mb-3">Informasi dasar</h5>

                            <div class="daftar-pelamar__proposal-info-box w-100 border mb-3">Wasyn Sulaiman Siregar
                            </div>
                            <div class="daftar-pelamar__proposal-info-box w-100 border mb-3">4342401034</div>
                            <div class="daftar-pelamar__proposal-info-box w-100 border mb-3">Teknik Informatika</div>
                            <div class="daftar-pelamar__proposal-info-box w-100 border mb-3">Program Studi</div>
                            <div class="daftar-pelamar__proposal-info-box w-100 border mb-3">wasyn@domain.com</div>
                            <div class="daftar-pelamar__proposal-info-box w-100 border mb-3">0812345678910</div>
                        </div>

                        <h5 class="apply-form-common-info-heaing fw-700 mb-0">Informasi Tambahan</h5>
                        <div class="apply-form-upload-file-info d-flex justify-content-between">
                            <span>Dapat berupa CV atau dokumen lainnya</span>
                            <span>Maks. 6 Dokumen</span>
                        </div>
                        <button for="upload-file"
                            class="apply-form-upload-file border border-0 text-white fw-700 text-center w-100">
                            <i class="bi bi-file-earmark-arrow-down me-1" onclick="installProposalFiles(1)"></i> Unduh
                            Dokumen</button>

                        {{-- this button will send a request to an api, and will return boolean condition which determine success or not --}}
                        <button type="button" onclick="showUpdateStatusProposal(1)"
                            class="apply-form-common-info-btn border border-0 text-white fw-700 d-block mx-auto mt-2 text-center px-2"
                            style="width: fit-content;">Perbarui Status Pelamar</button>
                    </div>
                </div>
            </div>

            {{-- pop up perbarui status lamaran mahasiswa --}}
            <div id="daftar-pelamar-update-proposal-status"></div>

            {{-- pop up opsi perbarui status lamaran mahasiswa --}}
            <div id="daftar-pelamar-update-option-proposal-status">
            </div>

            {{-- pop up notifikasi update status proposal --}}
            <div id="daftar-pelamar-update-proposal-status-notification">
            </div>

            {{-- pop up pesan konfirmasi penghapusan pelamar --}}
            <div id="daftar-pelamar-hapus-pelamar">
            </div>

            {{-- pop up notifikasi ingin logout --}}
            <x-logout-card />

            {{-- tambah lowongan untuk perusahaan --}}
            <div id="add-vacancy"></div>


        </main>
    </div>

    {{-- script jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- script js buat logika fitur pada halaman beranda dashboard mahasiswa, perusahaan dan admin --}}
    <script defer src="{{ asset('js/dashboard-new.js') }}"></script>

    {{-- script js buat logika fitur pada halaman daftar pelamar perusahaan --}}
    <script defer src="{{ asset('js/company/daftar-pelamar.js') }}"></script>

</body>

</html>
