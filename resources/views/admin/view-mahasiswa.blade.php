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

        {{-- dashboard navbar samping kanan --}}
        <x-dashboard-navbar :role="$role" />

        {{-- content dashboard utama --}}
        <main class="dashboard-main position-relative">

            {{-- photo profile dan nama mahasiswa --}}
            <div class="dashboard-main-nav border-bottom border-black px-5 py-3">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center gap-1 mb-2">
                        <img src="{{ asset('storage/' . $user->$role->profile->photo_profile) }}" alt=""
                            class="profile-img rounded-circle shadow">
                        <span class="profile-name">{{ $fullName }}</span>
                    </div>
                </div>
            </div>

            {{-- form edit profile mahasiswa --}}
            <div class="mx-auto mt-4 d-flex h-100 gap-5" style="width: calc(100% - 50px)">
                <div class="profile-info w-50 position-relative">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('storage/' . $student->profile->photo_profile) }}" alt="Someone profile"
                            class="profile__profile-img rounded bg-white">
                        <div class="w-100">
                            <div
                                class="profile__profile-nama-lengkap focus-ring border border-0  bg-white rounded p-2 w-100">
                                {{ $student->profile->first_name . ' ' . $student->profile->last_name ?? null }}
                            </div>
                            <span class="fw-700" style="font-size: .9rem">Mahasiswa</span>
                        </div>
                    </div>
                    <form method="POST" id="edit-profile-form" class="profile__profile-more-info mt-4">
                        <label for="asal-institusi" style="font-size: .95rem">Asal institusi</label>
                        <div class="border border-0 rounded p-1 px-2 focus-ring bg-white">
                            {{ $student->institute }}
                        </div>

                        <label for="jurusan" style="font-size: .95rem">Jurusan</label>
                        <div class="border border-0 rounded p-1 px-2 focus-ring bg-white">
                            {{ $student->profile->major->name ?? null }}
                        </div>

                        <label for="program-studi" style="font-size: .95rem">Program studi</label>
                        <div class="border border-0 rounded p-1 px-2 focus-ring bg-white">
                            {{ $student->profile->study_program ?? null }}
                        </div>

                        <label for="keahlian" style="font-size: .95rem">Keahlian</label>
                        <div class="border border-0 rounded p-1 px-2 focus-ring bg-white">
                            {{ $student->profile->skill ?? null }}
                        </div>

                        <label for="alamat" style="font-size: .95rem">Alamat</label>
                        <div class="border border-0 rounded p-1 px-2 focus-ring bg-white">
                            {{ $student->profile->location ?? null }}
                        </div>

                        <label for="kota" style="font-size: .95rem">Kota</label>
                        <div class="border border-0 rounded p-1 px-2 focus-ring bg-white">
                            {{ $student->profile->city ?? null }}
                        </div>

                        <label for="kode-pos" style="font-size: .95rem">Kode Pos</label>
                        <div class="border border-0 rounded p-1 px-2 focus-ring bg-white">
                            {{ $student->profile->postal_code ?? null }}
                        </div>

                        <label for="nomor-telepon" style="font-size: .95rem">Nomor telepon</label>
                        <div class="border border-0 rounded p-1 px-2 focus-ring bg-white">
                            {{ $student->profile->phone_number ?? null }}
                        </div>

                        <label for="email" style="font-size: .95rem">Email</label>
                        <div class="border border-0 rounded p-1 px-2 focus-ring bg-white">
                            {{ $student->account->email }}
                        </div>
                    </form>
                    <div class="position-absolute" style="bottom: 10px;">
                        <button class="border click-animation border-0 bni-blue text-white fw-700 p-1 rounded"
                            style="font-size: .9rem; width: 100px;" onclick="history.back()">Kembali</button>
                    </div>
                </div>
                <div class="profile__profile-description w-50">
                    <div class="h-100">
                        <span class="fw-700 mb-2 d-block" style="font-size: .9rem">Deskripsi Profil Mahasiswa</span>
                        <div class="bg-white shadow overflow-auto px-3 py-2 focus-ring border border-0 w-100 overflow-x-hidden overflow-y-auto"
                            style="font-size: .9rem; height: 435px; text-align: justify; line-height: 1.5rem; border-radius: 20px; word-wrap: break-word">
                            {{ $student->profile->description }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- pop up notifikasi custom --}}
            <div id="custom-notification"
                class="d-none position-absolute top-0 end-0 bottom-0 start-0 d-flex align-items-center justify-content-center z-1"
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
                        onclick="showCustomNotification()" style="font-size: .85rem;">Tutup</button>
                </div>
            </div>

            {{-- pop up notifikasi ingin logout --}}
            <x-logout-card />

        </main>
    </div>


    {{-- script jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- script js buat logika fitur umum pada dashboard mahasiswa, perusahaan dan admin --}}
    <script src="{{ asset('js/dashboard.js') }}"></script>

</body>

</html>
