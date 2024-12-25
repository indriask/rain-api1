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
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <title>Profile Perusahaan | RAIN</title>
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

        {{-- dashboard navbar samping kanan --}}
        <x-dashboard-navbar :role="$role" />

        {{-- content dashboard utama --}}
        <main class="dashboard-main position-relative">

            {{-- photo profile dan nama mahasiswa --}}
            <div class="dashboard-main-nav border-bottom border-black px-5 py-3">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center gap-1 mb-2">
                        <img src="{{ asset('storage/default/profile_company.jpg') }}" alt=""
                            class="profile-img rounded-circle shadow">
                        <span class="profile-name">Nama Perusahaan</span>
                    </div>
                </div>
            </div>

            {{-- form edit profile mahasiswa --}}
            <div class="mx-auto mt-4 d-flex h-100 gap-5" style="width: calc(100% - 50px)">
                <div class="profile-info w-50 position-relative">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('storage/default/profile_company.jpg') }}" alt="Someone profile"
                            class="profile__profile-img rounded">
                        <div class="w-100">
                            <input type="text" name="nama" form="edit-profile-form" value="Wasyn Sulaiman Siregar"
                                class="profile__profile-nama-lengkap focus-ring border border-0  bg-white rounded p-2 w-100">
                            <inpu class="fw-700" style="font-size: .9rem">Perusahaan</inpu>
                        </div>
                    </div>
                    <form method="POST" id="edit-profile-form" class="profile__profile-more-info mt-2">
                        <label style="font-size: .95rem">NIB</label>
                        <input type="text" class="border border-0 rounded p-1 px-2 focus-ring">

                        <label style="font-size: .95rem">Jenis</label>
                        <input type="text" class="border border-0 rounded p-1 px-2 focus-ring">

                        <label style="font-size: .95rem">Alamat</label>
                        <input type="text" class="border border-0 rounded p-1 px-2 focus-ring">

                        <label style="font-size: .95rem">Kota</label>
                        <input type="text" class="border border-0 rounded p-1 px-2 focus-ring">

                        <label style="font-size: .95rem">Kode Pos</label>
                        <input type="text" class="border border-0 rounded p-1 px-2 focus-ring">

                        <label style="font-size: .95rem">Tanggal Berdisi</label>
                        <input type="text" class="border border-0 rounded p-1 px-2 focus-ring">

                        <label style="font-size: .95rem">Bidang Usaha</label>
                        <input type="text" class="border border-0 rounded p-1 px-2 focus-ring">

                        <label style="font-size: .95rem">Nomor telepon</label>
                        <input type="text" class="border border-0 rounded p-1 px-2 focus-ring">

                        <label style="font-size: .95rem">Email</label>
                        <input type="text" class="border border-0 rounded p-1 px-2 focus-ring">

                        <label style="font-size: .95rem">Status</label>
                        <input type="text" class="border border-0 rounded p-1 px-2 focus-ring">

                    </form>
                    <div class="position-absolute" style="bottom: 10px;">
                        <button class="border click-animation border-0 bni-blue text-white fw-700 p-1 rounded"
                            style="font-size: .9rem; width: 100px;" onclick="history.back()">Kembali</button>
                        <button class="border click-animation border-0 bni-blue text-white fw-700 p-1 rounded"
                            style="font-size: .9rem; width: 100px;"
                            onclick="showVerifyCompany({{ $id_vacancy }})">Verifikasi</button>
                    </div>
                </div>
                <div class="profile__profile-description w-50">
                    <div class="h-100">
                        <span class="fw-700 mb-2 d-block" style="font-size: .9rem">Deskripsi Profil Perusahaan</span>
                        <textarea form="edit-profile-form" name="description"
                            class="bg-white shadow overflow-auto px-3 py-2 focus-ring border border-0 w-100"
                            style="font-size: .9rem; height: 435px; text-align: justify; line-height: 1.5rem; border-radius: 20px;">A small description about yourself</textarea>
                    </div>
                </div>
            </div>

            {{-- pop up pesan notifikasi verifikasi akun perusahaan --}}
            <div id="verify-company-account"
                class="d-none position-absolute top-0 end-0 start-0 bottom-0 d-flex align-items-center justify-content-center"
                style="background-color: rgba(0, 0, 0, .4);">
                <div class="profile__profile-delete-account bg-white" style="width: 600px;">
                    <div class="d-flex">
                        <button onclick="showVerifyCompany()"
                            class="profile__profile-close-btn click-animation ms-auto bni-blue text-white border border-0">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </div>
                    <div class="py-3 px-5">
                        <span class="fw-600 text-center" style="font-size: .9rem;">Apakah anda yakin bahwa seluruh
                            informasi yang diberikan sudah benar?</span>
                        <strong class="text-center d-block" style="font-size: 1.3rem;">Lakukan verifikasi jika
                            benar!</strong>
                        <button id="verify-company-action-btn" onclick=""
                            class="border border-0 click-animation bni-blue text-white d-block mx-auto fw-700 mt-4"
                            style="width: 120px; padding: 6px 10px; border-radius: 10px; font-size: .9rem">Verifikasi</button>
                    </div>
                </div>

            </div>

            {{-- pop up notifikasi berhasil atau gagal verifikasi akun perusahaan --}}
            <div id="verify-notification-card"
                class="d-none position-absolute top-0 end-0 start-0 bottom-0 d-flex align-items-center justify-content-center"
                style="background-color: rgba(0, 0, 0, .4);">
                <div class="profile__profile-delete-account bg-white" style="width: 600px;">
                    <div class="d-flex">
                        <button onclick="showVerifyNotificationCard()"
                            class="profile__profile-close-btn click-animation ms-auto bni-blue text-white border border-0">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </div>
                    <div class="py-3 px-5 d-flex align-items-center flex-column position-relative gap-3">
                        <span class="fw-700 text-center d-block position-relative z-1" style="font-size: 1.3rem" id="verify-notification-message" style="font-size: .9rem;">Akun berhasil diverifikasi!</span>
                        <img id="verify-notification-icon" class="position-absolute" style="aspect-ratio: 1/1; width: 70px; bottom: 4.5rem; opacity: .5;" src="{{ asset('storage/svg/success-checkmark.svg') }}" alt="">
                        <button id="verify-company-action-btn" onclick="showVerifyNotificationCard()"
                            class="border border-0 click-animation bni-blue text-white d-block mx-auto fw-700 mt-4"
                            style="width: 120px; padding: 6px 10px; border-radius: 10px; font-size: .9rem">Kembali</button>
                    </div>
                </div>

            </div>

            {{-- pop up notifikasi ingin logout --}}
            <x-logout-card />

        </main>
    </div>


    {{-- script jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- script js buat logika fitur umum pada dashboard mahasiswa, perusahaan dan admin --}}
    <script defer src="{{ asset('js/dashboard.js') }}"></script>

    {{-- script js buat logika fitur dashboard profile mahasiswa --}}
    <script defer src="{{ asset('js/admin/kelola-perusahaan.js') }}"></script>

</body>

</html>
