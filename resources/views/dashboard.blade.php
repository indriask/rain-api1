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

<body onload="getDataOnLoad()">

    <div class="dashboard-layout">

        {{-- dashboard aside navigation --}}
        <x-dashboard-navbar :role="$role" />

        {{-- content dashboard utama --}}
        <main class="dashboard-main position-relative">
            {{-- user profile and filter input --}}
            <div class="dashboard-main-nav border-bottom border-black px-5 py-3">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center gap-1 mb-2">
                        <img src="http://localhost:8000/storage{{ $user->$role->profile->photo_profile }}"
                            alt="" class="profile-img rounded-circle shadow">
                        <span
                            class="profile-name">{{ "{$user->$role->profile->first_name} {$user->$role->profile->last_name}" }}</span>
                    </div>
                    <div class="position-relative">
                        <input type="search" class="search-company bg-white border border-0 focus-ring shadow"
                            name="cari-perusahaan" placeholder="Cari perusahaan">
                        <i class="bi bi-search search-icon"></i>
                    </div>
                </div>
                <div class="select-container w-100 mt-2 d-flex gap-3">
                    <div class="select-container">
                        <select name="" id="">
                            <option>Pilih jurusan</option>
                            <option value="Manajemen & Bisnis">Manajemen & Bisnis</option>
                            <option value="Teknik Elektro">Teknik Elektro</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Teknik Mesin">Teknik Mesin</option>
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    <div class="select-container">
                        <select name="" id="">
                            <option>Pilih prodi</option>
                        </select>
                        <div class="select-bg"></div>
                    </div>
                    <div class="select-container">
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
                </div>
            </div>

            {{-- vacancy card list --}}
            <div id="card-container" class="overflow-auto">
                <div id="vacancy-card-list-container" class="overflow-auto position-relative h-100">
                    <div id="vacancy-card-list" class="vacancy-card-list px-3 gap-3 mt-4">
                    </div>
                </div>
            </div>

            {{-- vacancy detail card --}}
            <div id="vacancy-detail-card"
                class="d-none position-absolute vacancy-apply-form top-0 start-0 bottom-0 end-0 d-flex justify-content-center overflow-auto">
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
            <div id="add-vacancy"></div>
        </main>
    </div>

    <script defer src="{{ asset('js/dashboard.js') }}"></script>

</body>

</html>
