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
                        <img src="{{ asset('storage/' . $profile->photo_profile) }}" alt=""
                            class="profile-img rounded-circle shadow">
                        <span class="profile-name">{{ $fullName }}</span>
                    </div>
                </div>
            </div>

            {{-- profile section perusahaan --}}
            <div class="mx-auto mt-4 d-flex h-100 gap-5" style="width: calc(100% - 50px)">
                <div class="profile-info w-50 position-relative">
                    <div class="d-flex align-items-center gap-3">
                        <label for="input-photo-profile">
                            <img src="{{ asset('storage/' . $profile->photo_profile) }}" id="user-profile"
                                alt="Someone profile" class="profile__profile-img rounded cursor-pointer bg-white">
                        </label>
                        <div class="w-100">
                            <input type="text" form="edit-admin-profile-form" name="fullname"
                                value="{{ $fullName }}"
                                class="profile__profile-nama-lengkap border focus-ring border-0 bg-white rounded p-2 w-100">
                            <span class="fw-700 d-block" style="font-size: .9rem">Admin</span>
                        </div>
                    </div>
                    <form method="POST" id="edit-admin-profile-form" class="profile__profile-more-info mt-4"
                        enctype="multipart/form-data">
                        <input type="file" hidden id="input-photo-profile" name="photo_profile"
                            onchange="handleProfileFile()">
                        <input type="text" hidden id="input-old-photo-profile" name="old_photo_profile"
                            value="{{ $profile->photo_profile }}">

                        <label for="asal-institusi" style="font-size: .95rem">Asal institusi</label>
                        <input type="text" name="institute" class="border border-0 focus-ring rounded p-1 px-2"
                            value="{{ $user->$role->institute ?? null }}">

                        <label for="alamat" style="font-size: .95rem">Alamat</label>
                        <input type="text" name="location" class="border border-0 focus-ring rounded p-1 px-2"
                            value="{{ $profile->location ?? null }}">

                        <label for="kota" style="font-size: .95rem">Kota</label>
                        <input type="text" name="city" class="border border-0 focus-ring rounded p-1 px-2"
                            value="{{ $profile->city ?? null }}">

                        <label for="kode-pos" style="font-size: .95rem">Kode Pos</label>
                        <input type="text" name="postal_code" class="border border-0 focus-ring rounded p-1 px-2"
                            value="{{ $profile->postal_code ?? null }}">

                        <label for="nomor-telepon" style="font-size: .95rem">Nomor telepon</label>
                        <input type="text" name="phone_number" class="border border-0 focus-ring rounded p-1 px-2"
                            value="{{ $profile->phone_number ?? null }}">

                        <label style="font-size: .95rem">Email</label>
                        <input type="text disabled" disabled class="border border-0 focus-ring rounded p-1 px-2"
                            value="{{ $user->email }}">

                        <label style="font-size: .95rem">privilege</label>
                        <input type="text disabled" disabled class="border border-0 focus-ring rounded p-1 px-2"
                            value="{{ $user->$role->privilege}}">
                    </form>
                    <div class="position-absolute" style="bottom: 10px;">
                        <button class="border border-0 bni-blue text-white fw-700 p-1 rounded"
                            style="font-size: .9rem; width: 100px;"
                            onclick="window.location.href='{{ route('dashboard') }}'">Kembali</button>
                    </div>
                </div>
                <div class="profile__profile-description w-50">
                    <div class="d-flex">
                        <button class="border border-0 click-animation bni-blue text-white fw-700 rounded p-2 ms-auto"
                            style="font-size: .8rem; width: 100px;" id="edit-profile-btn"
                            onclick="editProfileAdminData()">Edit Profil</button>
                    </div>
                    <div class="h-100">
                        <span class="fw-700 mb-2 d-block" style="font-size: .9rem">Deskripsi Profil Admin</span>
                        <textarea form="edit-admin-profile-form" name="description"
                            class="bg-white shadow border border-0 w-100 px-3 py-2 focus-ring"
                            style="font-size: .9rem; height: 435px; text-align: justify; line-height: 1.5rem; border-radius: 20px;">{{ $profile->description }}</textarea>
                    </div>
                </div>
            </div>

            {{-- pop up pesan notifikasi berhasil atau gagal edit --}}
            <div id="edit-admin-profile-notification">
            </div>

            {{-- pop up notifikasi custom --}}
            <div id="custom-notification"
                class="d-none position-absolute top-0 end-0 bottom-0 start-0 d-flex align-items-center justify-content-center"
                style="background-color: rgba(0, 0, 0, .4)">
                <div class="bg-white py-5 px-3 rounded">
                    <div class="position-relative d-flex flex-column align-items-center">
                        <img id="custom-notification-icon" class="" src="" style="width: 60px;"
                            alt="">
                        <h6 class="position-relative z-1 fw-700 mb-0 mt-1" id="custom-notification-title"></h6>
                        <span class="text-body-secondary text-center" style="font-size: .85rem; width: 400px;"
                            id="custom-notification-message"></span>
                    </div>
                    <button
                        class="bni-blue text-white fw-700 rounded border border-0 d-block mx-auto mt-4 px-4 py-2 click-animation"
                        onclick="showCustomNotification()">Tutup</button>
                </div>
            </div>

            {{-- pop up notifikasi ingin logout --}}
            <x-logout-card />

        </main>
    </div>

    {{-- script jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- script js buat logika fitur pada halaman beranda dashboard mahasiswa, perusahaan dan admin --}}
    <script defer src="{{ asset('js/dashboard.js') }}"></script>

    {{-- script js buat logika fitur pada halaman profile perusahaan --}}
    <script defer src="{{ asset('js/admin/profile.js') }}"></script>

</body>

</html>
