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
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <title>Wasyn Sulaiman Siregar Profile | RAIN</title>
</head>

<body>

    <div class="dashboard-layout">

        {{-- dashboard aside navigation --}}
        <aside class="aside-nav border-end border-black px-2">
            <div class="d-flex align-items-center border-bottom border-black">
                <img class="logo-img" src="{{ asset('storage/2d-logo.png') }}" alt="RAIN Team">
                <h2 class="logo-title position-relative" style="right: 10px;">RAIN</h2>
            </div>
            <div class="aside-list py-4">
                <div class="border-bottom border-black" style="height: 300px;">
                    <p class="aside-subheading">MENU UTAMA</p>
                    <a href="{{ route('dashboard') }}" class="text-underline">
                        <div class="aside-list-item py-2 px-2 text-white mb-2" onclick=""><i
                                class="bi bi-house-door me-1"></i> Beranda</div>
                    </a>
                    <a href="{{ route('student-daftar-lamaran') }}" class="text-underline">
                        <div class="aside-list-item py-2 px-2 text-white mb-2">
                            <i class="bi bi-card-list me-1"></i>Daftar Lamaran
                        </div>
                    </a>

                    @if (false)
                        <div class="aside-list-item py-2 px-2 text-white mb-2" onclick=""><i
                                class="bi bi-plus-circle me-1"></i> Tambah Lowongan</div>
                        <div class="aside-list-item py-2 px-2 text-white mb-2" onclick=""><i
                                class="bi bi-window me-1"></i> Kelola Lowongan</div>
                        <div class="aside-list-item py-2 px-2 text-white mb-2" onclick=""><i
                                class="bi bi-person-vcard me-1"></i> Daftar Pelamar</div>
                    @endif
                </div>
                <div class="">
                    <p class="aside-subheading">Lainnya</p>
                    <a href="{{ route($role === 'student' ? 'student-profile' : 'company-profile') }}"
                        class="text-underline">
                        <div class="aside-list-item py-2 px-2 text-white mb-2 cursor-pointer" onclick="">
                            <i class="bi bi-gear me-1"></i>Pengaturan
                        </div>
                    </a>
                    <div class="aside-list-item py-2 px-2 text-white mb-2" onclick=""><i
                            class="bi bi-box-arrow-left me-1"></i> Keluar</div>
                </div>
            </div>
        </aside>

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
                    {{-- <div class="position-relative">
                        <input type="search" class="search-company bg-white border border-0 focus-ring shadow"
                            name="cari-perusahaan" placeholder="Cari perusahaan">
                        <i class="bi bi-search search-icon"></i>
                    </div> --}}
                </div>
                {{-- <div class="select-container w-100 mt-2 d-flex gap-3">
                    <div class="select-container">
                        <select name="" id="">
                            <option>Pilih jurusan</option>
                            <option>teknik informatika</option>
                            <option>teknik elektro</option>
                            <option>teknik mesin</option>
                            <option>teknologi rekayasa elektronik</option>
                            <option>teknologi rekayasa rekontruksi perkapalan</option>
                            <option>teknologi rekayasa pengelasan dan fabrikasi</option>
                            <option>tekn</option>
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    <div class="select-container">
                        <select name="" id="">
                            <option>Pilih prodi</option>
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    <div class= "select-container">
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
                </div> --}}
            </div>

            {{-- profile section mahasiswa --}}
            <div class="mx-auto mt-4 d-flex h-100 gap-5" style="width: calc(100% - 50px)">
                <div class="profile-info w-50 position-relative">
                    <div class="d-flex align-items-center gap-3">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQE6-KsNGUoKgyIAATW1CNPeVSHhZzS_FN0Zg&s"
                            alt="Someone profile" class="profile__profile-img rounded">
                        <div class="w-100">
                            <div class="profile__profile-nama-lengkap bg-white rounded p-2">Wasyn Sulaiman Siregar</div>
                            <span class="fw-700" style="font-size: .9rem">Mahasiswa</span>
                        </div>
                    </div>
                    <div method="POST" action="" class="profile__profile-more-info mt-4">
                        <label for="" style="font-size: .95rem">Asal institusi</label>
                        <input type="text" name="asal-institusi" class="border border-0 rounded p-1 px-2"
                            value="Politeknik Negeri Batam">

                        <label for="" style="font-size: .95rem">Jurusan</label>
                        <input type="text" name="asal-institusi" class="border border-0 rounded p-1 px-2"
                            value="Teknik Informatika">

                        <label for="" style="font-size: .95rem">Program studi</label>
                        <input type="text" name="asal-institusi" class="border border-0 rounded p-1 px-2"
                            value="Teknologi Rekayasa Perangkat Lunak">

                        <label for="" style="font-size: .95rem">Keahlian</label>
                        <input type="text" name="asal-institusi" class="border border-0 rounded p-1 px-2"
                            value="Hack website NASA">

                        <label for="" style="font-size: .95rem">Alamat</label>
                        <input type="text" name="asal-institusi" class="border border-0 rounded p-1 px-2"
                            value="Batam, Nogsa">

                        <label for="" style="font-size: .95rem">Kota</label>
                        <input type="text" name="asal-institusi" class="border border-0 rounded p-1 px-2"
                            value="Kota Batam">

                        <label for="" style="font-size: .95rem">Kode Pos</label>
                        <input type="text" name="asal-institusi" class="border border-0 rounded p-1 px-2"
                            value="12345">

                        <label for="" style="font-size: .95rem">Nomor telepon</label>
                        <input type="text" name="asal-institusi" class="border border-0 rounded p-1 px-2"
                            value="081234567890">

                        <label for="" style="font-size: .95rem">Email</label>
                        <input type="text" name="asal-institusi" class="border border-0 rounded p-1 px-2"
                            value="eric@laravel.com">
                    </div>
                    <div class="position-absolute" style="bottom: 10px;">
                        <button class="border border-0 bni-blue text-white fw-700 p-1 rounded"
                            style="font-size: .9rem; width: 100px;"
                            onclick="window.location.href='{{ route('dashboard') }}'">Kembali</button>
                        <button class="border border-0 bni-blue text-white fw-700 p-1 rounded"
                            style="font-size: .9rem; width: 100px;">Hapus akun</button>
                    </div>
                </div>
                <div class="profile__profile-description w-50">
                    <div class="d-flex">
                        <button class="border border-0 bni-blue text-white fw-700 rounded p-2 ms-auto"
                            style="font-size: .8rem; width: 100px;">Edit Profil</button>
                    </div>
                    <div class="h-100">
                        <span class="fw-700 mb-2 d-block" style="font-size: .9rem">Deskripsi Profil Mahasiswa</span>
                        <div class="bg-white shadow overflow-auto px-3 py-2"
                            style="font-size: .9rem; height: 435px; text-align: justify; line-height: 1.5rem; border-radius: 20px;">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nisi perferendis in soluta illum
                            delectus eos possimus aspernatur, ea placeat ad voluptates inventore non temporibus expedita
                            ratione quae consequuntur quod obcaecati? Quo, asperiores inventore! Error exercitationem
                            delectus eaque iure ipsum numquam repudiandae placeat rem aliquam, quisquam, porro at! Ad
                            quaerat ducimus tempora earum porro similique velit illum hic esse, consectetur aliquid
                            provident voluptate eligendi harum, odio eveniet, rerum consequuntur. Facere, perspiciatis
                            pariatur? Dolore debitis aliquid eius nobis deserunt sint accusantium fugit illo impedit,
                            optio sit consequuntur laboriosam inventore dolores quo sequi dolorem necessitatibus?
                            Repellat assumenda voluptate unde. Ipsa nihil eligendi maiores!
                        </div>
                    </div>
                </div>
            </div>

            {{-- notifikasi berhasil edit profile --}}
            <div class="position-absolute top-0 end-0 bottom-0 start-0 d-flex align-items-center justify-content-center"
                style="background-color: rgba(0, 0, 0, .4)">
                <div class="profile__profile-edit-notification bg-white p-5 d-flex justify-content-center align-items-center">
                   <div>
                        <h5 class="fw-700 text-center">Profile berhasil diperbaharui!</h5>
                        <button class="profile__profile-edit-notification-btn border border-0 bni-blue fw-700 text-white d-block mx-auto mt-4">Kembali</button>
                   </div>
                </div>
            </div>

        </main>
    </div>

    <script defer src="{{ asset('js/dashboard.js') }}"></script>

</body>

</html>
