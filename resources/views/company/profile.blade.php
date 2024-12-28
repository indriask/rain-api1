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

    <title>Profile | RAIN</title>
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

        {{-- dashboard navbar --}}
        <x-dashboard-navbar :role="$role" />

        {{-- content dashboard utama --}}
        <main class="dashboard-main position-relative">

            {{-- user profile and filter input --}}
            <div class="dashboard-main-nav border-bottom border-black px-5 py-3">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center gap-1 mb-2">
                        <img src="{{ asset('storage/' . $user->$role->profile->photo_profile) }}" alt=""
                            class="profile-img rounded-circle shadow">
                        <span class="profile-name">{{ $profile->first_name . ' ' . $profile->last_name }}</span>
                    </div>
                </div>
            </div>

            {{-- profile section perusahaan --}}
            <div class="mx-auto mt-3 d-flex h-100 gap-5" style="width: calc(100% - 50px)">
                <div class="profile-info w-50 position-relative">
                    <div class="d-flex align-items-center gap-3">
                        <label for="input-photo-profile" class="cursor-pointer">
                            <img src="{{ asset('storage/' . $profile->photo_profile) }}" alt="Someone profile"
                                class="profile__profile-img rounded">
                        </label>
                        <div class="w-100">
                            <input type="text" form="edit-company-profile-form" name="fullname" id="input-fullname"
                                value="{{ $fullName }}"
                                class="profile__profile-nama-lengkap border focus-ring border-0 bg-white rounded p-2 w-100">
                            <span class="fw-700 d-block" style="font-size: .9rem">Perusahaan</span>
                        </div>
                    </div>
                    <form method="POST" id="edit-company-profile-form" class="profile__profile-more-info mt-2"
                        enctype="multipart/form-data">
                        <input type="file" hidden id="input-photo-profile" name="photo-profile">
                        <input type="text" hidden id="input-old-photo-profile" name="old-photo-profile"
                            value="{{ $profile->photo_profile }}">

                        <label for="input-type" style="font-size: .95rem">NIB</label>
                        <input type="text" disabled name="" id="input-type"
                            class="border border-0 focus-ring rounded p-1 px-2" value="{{ $user->$role->nib }}">

                        <label for="input-type" style="font-size: .95rem">Jenis</label>
                        <input type="text" name="type" id="input-type"
                            class="border border-0 focus-ring rounded p-1 px-2" value="{{ $user->$role->type }}">

                        <label for="input-location" style="font-size: .95rem">Alamat</label>
                        <input type="text" name="location" id="input-location"
                            class="border border-0 focus-ring rounded p-1 px-2" value="{{ $profile->location }}">

                        <label for="input-city" style="font-size: .95rem">Kota</label>
                        <input type="text" name="city" id="input-city"
                            class="border border-0 focus-ring rounded p-1 px-2" value="{{ $profile->city }}">

                        <label for="input-postal-code" style="font-size: .95rem">Kode Pos</label>
                        <input type="text" name="postal-code" id="input-postal-code"
                            class="border border-0 focus-ring rounded p-1 px-2" value="{{ $profile->postal_code }}">

                        <label for="input-founded-date" style="font-size: .95rem">Tanggal berdiri</label>
                        <input type="date" name="founded-date" id="input-founded-date"
                            class="border border-0 focus-ring rounded p-1 px-2"
                            value="{{ $user->$role->founded_date }}">

                        <label for="input-business-fields" style="font-size: .95rem">Bidang Usaha</label>
                        <input type="text" name="business-fields" id="input-business-fields"
                            class="border border-0 focus-ring rounded p-1 px-2"
                            value="{{ $user->$role->business_fields }}">

                        <label for="input-phone-number" style="font-size: .95rem">Nomor telepon</label>
                        <input type="text" name="phone-number" id="input-phone-number"
                            class="border border-0 focus-ring rounded p-1 px-2" value="{{ $profile->phone_number }}">

                        <label for="email" style="font-size: .95rem">Email</label>
                        <input type="text" disabled id="input-email"
                            class="border border-0 focus-ring rounded p-1 px-2" value="{{ $user->email }}">

                        <label for="input-status" style="font-size: .95rem">Status</label>
                        <input type="text" disabled name="email"
                            class="border border-0 focus-ring rounded p-1 px-2"
                            value="{{ $user->$role->status_verified_at ?? 'Unverified' }}">
                    </form>
                    <div class="position-absolute" style="bottom: 10px;">
                        <button class="border border-0 bni-blue text-white fw-700 p-1 rounded"
                            style="font-size: .9rem; width: 100px;"
                            onclick="window.location.href='{{ route('dashboard') }}'">Kembali</button>
                        <button onclick="showDeleteAccountCard()"
                            class="border border-0 bni-blue text-white fw-700 p-1 rounded"
                            style="font-size: .9rem; width: 100px;">Hapus akun</button>
                    </div>
                </div>
                <div class="profile__profile-description w-50">
                    <div class="d-flex">
                        <button class="border border-0 click-animation bni-blue text-white fw-700 rounded p-2 ms-auto"
                            style="font-size: .8rem; width: 100px;" id="edit-profile-btn"
                            onclick="editProfileCompanyData()">Edit Profil</button>
                    </div>
                    <div class="h-100">
                        <span class="fw-700 mb-2 d-block" style="font-size: .9rem">Deskripsi Profil Perusahaan</span>
                        <textarea form="edit-company-profile-form" name="description" id="input-description"
                            class="bg-white shadow border border-0 w-100 px-3 py-2 focus-ring"
                            style="font-size: .9rem; height: 435px; text-align: justify; line-height: 1.5rem; border-radius: 20px;">{{ $profile->description }}</textarea>
                    </div>
                </div>
            </div>

            {{-- pop up pesan notifikasi berhasil atau gagal edit --}}
            <div id="edit-company-profile-notification">
            </div>

            {{-- pop up pesan notifikasi ingin menghapus akun --}}
            <div id="delete-account-notification"
                class="d-none position-absolute top-0 end-0 start-0 bottom-0 d-flex align-items-center justify-content-center"
                style="background-color: rgba(0, 0, 0, .4)">
                <div class="profile__profile-delete-account bg-white">
                    <div class="d-flex">
                        <button onclick="showDeleteAccountCard()"
                            class="profile__profile-close-btn ms-auto bni-blue text-white border border-0">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </div>
                    <div class="py-3 px-5">
                        <span class="fw-600">Apakah anda yakin ingin menghapus akun ini?</span>
                        <button onclick="processDeleteAccountRequest()"
                            class="border border-0 bni-blue text-white d-block mx-auto fw-700 mt-4"
                            style="width: 120px; padding: 6px 10px; border-radius: 10px; font-size: .9rem">Hapus</button>
                    </div>
                </div>

            </div>

            {{-- pop up notifikasi custom --}}
            <div id="custom-notification"
                class="d-none position-absolute top-0 end-0 bottom-0 start-0 d-flex align-items-center justify-content-center"
                style="background-color: rgba(0, 0, 0, .4)">
                <div class="bg-white py-5 px-3 rounded">
                    <div class="position-relative d-flex flex-column align-items-center">
                        <img id="custom-notification-icon" class="position-absolute"
                            style="width: 60px; opacity: .3; top: -1.1rem;" alt="">
                        <h6 class="position-relative z-1 fw-700" id="custom-notification-message">Terjadi kesalahan
                            saat
                            penghapusan data</h6>
                    </div>
                    <button
                        class="bni-blue text-white fw-700 rounded border border-0 d-block mx-auto mt-4 px-4 py-2 click-animation"
                        onclick="showCustomNotification()">Tutup</button>
                </div>
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
    <script defer src="{{ asset('js/dashboard.js') }}"></script>

    {{-- script js buat logika fitur pada halaman profile perusahaan --}}
    <script defer src="{{ asset('js/company/profile.js') }}"></script>

</body>

</html>
