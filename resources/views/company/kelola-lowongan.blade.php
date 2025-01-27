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

    {{-- bootstrap icon web font link --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <title>Kelola Lowongan | RAIN</title>
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

    <div id="empty-vacancy-data-notification"
        class="d-none position-absolute top-0 start-0 end-0 z-1 border border-black">
        <div class="alert alert-warning alert-dismissible fade show mx-auto mt-4" role="alert"
            style="width: fit-content; font-size: .9rem;">
            <div class="d-flex align-items-center gap-1">
                <i class="bi bi-exclamation-triangle"></i>
                <div id="empty-vacancy-data-notification-title"></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    <div class="dashboard-layout">

        {{-- navigasi samping kiri dashboard --}}
        <x-dashboard-navbar :role="$role" />

        {{-- content dashboard utama --}}
        <main class="dashboard-main position-relative">

            {{-- bagian html profile user, search bar dan filter --}}
            <div class="dashboard-main-nav border-bottom border-black px-5 py-3">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center gap-1 mb-2">
                        <img src="{{ asset('storage/' . $user->$role->profile->photo_profile) }}" alt=""
                            class="profile-img rounded-circle shadow">
                        <span class="profile-name">{{ $fullName }}</span>
                    </div>
                </div>
            </div>

            {{-- menampilkan list lowongan yang sudah di publish --}}
            <div id="card-container" class="overflow-auto">
                <div id="vacancy-card-list-container" class="overflow-auto position-relative h-100">
                    <div id="vacancy-card-list" class="vacancy-card-list px-3 gap-3 mt-4 position-relative">
                        @foreach ($lowongan as $lowong)
                            <div class="vacancy-card bg-white py-3 px-4">
                                <div class="d-flex justify-content-between">
                                    <h5 class="salary-text">
                                        Rp. {{ number_format($lowong->salary, 0, ',', '.') }}/bulan
                                    </h5>
                                    <img class="company-photo rounded"
                                        src="{{ asset('storage/' . $lowong->company->profile->photo_profile) }}"
                                        alt="Company photo">
                                </div>
                                <div>
                                    <h6 class="vacancy-role m-0">{{ $lowong->title }}</h6>
                                    <span class="vacancy-major-choice">{{ $lowong->major->name }}</span>

                                    <ul class="vacancy-small-detail p-0 mt-3">
                                        <li><i class="bi bi-geo-alt me-3"></i>{{ $lowong->location }}</li>
                                        <li><i
                                                class="bi bi-calendar3 me-3"></i>{{ \Carbon\Carbon::parse($lowong->date_created)->format('d-F-Y') }}
                                        </li>
                                        <li><i class="bi bi-bar-chart-line me-3"></i>{{ $lowong->quota }} Kuota
                                        </li>
                                    </ul>

                                    <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                        <li class="bg-white rounded-pill text-center">{{ $lowong->time_type }}</li>
                                        <li class="bg-white rounded-pill text-center">{{ $lowong->type }}</li>
                                        <li class="bg-white rounded-pill text-center">{{ $lowong->duration }} Bulan
                                        </li>
                                    </ul>

                                    <button onclick="showDetailManageVacancy({{ $lowong->id_vacancy }})"
                                        class="vacancy-detail border border-0 click-animation text-white mx-auto d-block mt">Detail</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- menampilkan detail lowongan yang sudah di publish --}}
            <div id="manage-vacancy-detail"
                class="d-none position-absolute vacancy-apply-form top-0 start-0 bottom-0 end-0 d-flex justify-content-center overflow-auto"
                style="background-color: rgba(0, 0, 0, .4)">

            </div>

            {{-- pop up notifikasi custom --}}
            <div id="custom-notification"
                class="d-none position-absolute top-0 end-0 bottom-0 start-0 d-flex z-1 align-items-center justify-content-center z-1"
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

            {{-- tambah lowongan untuk perusahaan --}}
            <div id="add-vacancy"></div>

        </main>
    </div>

    {{-- bootstrap js link --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    {{-- script jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- script js buat logika fitur pada halaman beranda dashboard mahasiswa, perusahaan dan admin --}}
    <script defer src="{{ asset('js/dashboard.js') }}"></script>

    {{-- script js buat logika fitur pada halaman kelola lowondan perusahaan --}}
    <script defer src="{{ asset('js/company/kelola-lowongan.js') }}"></script>



</body>

</html>
