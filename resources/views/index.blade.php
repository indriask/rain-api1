<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <!-- google fonts plus jakarta sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- bootstrap icon web font link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- css link -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script>
        window.laravel = {
            csrf_token: '{{ csrf_token() }}'
        };
        
    </script>
</head>

<body>

    {{-- navbar section start --}}
    <nav class="navbar fixed-top shadow p-2 bg-white">
        <div class="container p-0">
            <div style="cursor: pointer" onclick="window.location.href='{{ route('home') }}'">
                <img src="{{ asset('storage/2d-logo.png') }}" class="rain-logo" alt="RAIN logo">
                <span class="logo-title">RAIN</span>
            </div>
            <div class="custom-nav-list">
                <a href="#beranda">Beranda</a>
                <a href="#fitur">Fitur</a>
                <a href="#tim">Tim</a>
                <a href="#kontak">Kontak</a>
                <a href="#tentang">Tentang</a>
            </div>
            <button class="login-button p-1 rounded-pill"
                onclick="window.location.href='{{ route('signin') }}'">Masuk</button>
        </div>
    </nav>
    {{-- navbar section end --}}



    {{-- hero image section start --}}
    <div id="beranda" class="container-fluid" style="margin-top: 3rem; margin-bottom: 18rem;">
        <div class="container px-0 d-flex align-items-center gap-1">
            <div class="custom-container-landing-page d-flex flex-column gap-3">
                <h5 class="landing-page-logo-title">READY FOR INTERNSHIP</h5>
                <h1 class="hero-heading">Temukan Magang dan Bangun Karirmu Dengan <span
                        style="color: var(--primary)">RAIN</span></h1>
                <p>
                    RAIN adalah aplikasi lowongan magang berbasis web yang dibuat khusus untuk mempermudah proses
                    perekrutran permagangan.
                </p>
                <div>
                    <button class="landing-page-button rounded-pill bg-white" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Mulai Sekarang!
                    </button>
                    <ul class="dropdown-menu mt-2" style="width: 200px;">
                        <li>
                            <a class="dropdown-item" href="{{ route('student-signup') }}">
                                <i class="bi bi-backpack3 me-1"></i>Mahasiswa</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('company-signup') }}">
                                <i class="bi bi-building me-1"></i>Perusahaan</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="position-relative">
                <img src="{{ asset('storage/svg/lading-page-img.svg') }}" class="landing-page-img" alt="">
                <img src="{{ asset('storage/svg/Arrow-15-blue.svg') }}" alt="Blue arrorw up ilustration"
                    class="arrow-up-ilustration position-absolute" style="bottom: -12rem; right:0;">
            </div>
        </div>
    </div>
    {{-- hero image section end --}}



    {{-- website feature section start --}}
    <div id="fitur" class="container-fluid" style="margin-bottom: 21rem">
        <div class="container">
            <div class="position-relative">
                <h1 class="website-feature-heading">
                    Fitur <span style="color: var(--primary)">RAIN</span>
                </h1>
                <img src="{{ asset('storage/svg/Arrow-13-blue.svg') }}" alt="Blue arrow down ilustration"
                    class="position-absolute" style="top: -12rem; left: 0;">
                <p style="width: 600px;">Kami ingin mengubah cara Mahasiswa Polibatam dalam mencari lowongan magang dan
                    mengubah cara
                    perusahaan dalam mencari talenta berkualitas di antara Mahasiswa Polibatam.</p>
            </div>
        </div>
        <div class="container d-flex justify-content-center flex-wrap gap-5 position-relative"
            style="margin-top: 4.5rem;">
            <div class="feature-card position-relative bg-white">
                <div class="feature-heading position-absolute rounded-pill text-center text-white start-0 end-0">
                    Pencarian Lowongan</div>
                <div class="mx-auto" style="width: fit-content;">
                    <i class="bi bi-search feature-icon"></i>
                    <p>Mencari lowongan dari berbagai perusahaan yang bekerja sama dengan RAIN</p>
                </div>
            </div>
            <div class="feature-card position-relative bg-white">
                <div class="feature-heading position-absolute rounded-pill text-center text-white start-0 end-0">
                    Formulir Lamaran</div>
                <div class="mx-auto" style="width: fit-content;">
                    <i class="bi bi-file-earmark-text feature-icon"></i>
                    <p>Formulir lamaran yang mudah di isi sesuai dengan format yang ditentukan</p>
                </div>
            </div>
            <div class="feature-card position-relative bg-white">
                <div class="feature-heading position-absolute rounded-pill text-center text-white start-0 end-0">
                    Filter Pencarian</div>
                <div class="mx-auto" style="width: fit-content;">
                    <i class="bi bi-sliders feature-icon"></i>
                    <p>Mencari lowongFilter pencarian menyaring hasil pencarian kedalam beberapa kriteria</p>
                </div>
            </div>
            <div class="feature-card position-relative bg-white">
                <div class="feature-heading position-absolute rounded-pill text-center text-white start-0 end-0">
                    Notifikasi Status</div>
                <div class="mx-auto" style="width: fit-content;">
                    <i class="bi bi-envelope feature-icon"></i>
                    <p>Mencari lowongan dari berbagai perusahaan yang bekerja sama dengan RAIN</p>
                </div>
            </div>
            <img src="{{ asset('storage/svg/Arrow-15-blue.svg') }}" class="position-absolute arrow-up-ilustration"
                style="bottom: -16rem; right: -3rem;" alt="Blue arrow up ilustration">
        </div>
    </div>
    {{-- website feature section end --}}



    {{-- Website development team sectiont start --}}
    <div id="tim" class="container-fluid" style="margin-bottom: 14rem;">
        <div class="container">
            <div class="position-relative">
                <h1 class="website-feature-heading">
                    Tim <span style="color: var(--primary)">RAIN</span>
                </h1>
                <img src="{{ asset('storage/svg/Arrow-13-blue.svg') }}" alt="Blue arrow down ilustration"
                    class="position-absolute" style="top: -12rem; left: 0;">
                <p style="width: 600px;">Halo, Kami adalah tim RAIN! Anda dapat mengetahui siapa yang membangun Ready
                    for Internship disini!</p>
            </div>
        </div>
        <div class="container" style="margin-top: 7rem;">
            <div class="row row-gap-5" style="margin-bottom: 5rem;">
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="profile-card mx-auto d-flex flex-column align-items-center position-relative">
                        <img src="{{ asset('storage/profile/Wasyn-removebg-preview.png') }}" alt=""
                            class="profile rounded-circle  bg-white position-absolute">
                        <h2 class="profile-name">Wasyn Sulaiman Siregar</h2>
                        <span class="profile-role">Frontend Developer</span>
                        <div class="my-2">
                            <i class="bi bi-instagram profile-icon"></i>
                            <i class="bi bi-telephone profile-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="profile-card mx-auto d-flex flex-column align-items-center position-relative">
                        <img src="{{ asset('storage/profile/Aidil-removebg-preview.png') }}" alt=""
                            class="profile rounded-circle bg-white position-absolute">
                        <h2 class="profile-name">Muhammad Aidil Jupriadi Saleh</h2>
                        <span class="profile-role">Data dan Sistem Analis</span>
                        <div class="my-2">
                            <i class="bi bi-instagram profile-icon"></i>
                            <i class="bi bi-telephone profile-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="profile-card mx-auto d-flex flex-column align-items-center position-relative">
                        <img src="{{ asset('storage/profile/Indria-removebg-preview.png') }}" alt=""
                            class="profile rounded-circle bg-white position-absolute">
                        <h2 class="profile-name">Indria Bintani Askia</h2>
                        <span class="profile-role">Backend Developer</span>
                        <div class="my-2">
                            <i class="bi bi-instagram profile-icon"></i>
                            <i class="bi bi-telephone profile-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-gap-5">
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="profile-card mx-auto d-flex flex-column align-items-center position-relative">
                        <img src="{{ asset('storage/profile/Fito-removebg-preview.png') }}" alt=""
                            class="profile rounded-circle bg-white position-absolute">
                        <h2 class="profile-name">Fito Desta Fabiansyah</h2>
                        <span class="profile-role">Backend Developer</span>
                        <div class="my-2">
                            <i class="bi bi-instagram profile-icon"></i>
                            <i class="bi bi-telephone profile-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="profile-card mx-auto d-flex flex-column align-items-center position-relative">
                        <img src="{{ asset('storage/profile/Winda-removebg-preview.png') }}" alt=""
                            class="profile rounded-circle bg-white position-absolute">
                        <h2 class="profile-name">Winda Tri Wulandari</h2>
                        <span class="profile-role">Designer</span>
                        <div class="my-2">
                            <i class="bi bi-instagram profile-icon"></i>
                            <i class="bi bi-telephone profile-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="profile-card mx-auto d-flex flex-column align-items-center position-relative">
                        <img src="{{ asset('storage/profile/Eric-removebg-preview.png') }}" alt=""
                            class="profile rounded-circle bg-white position-absolute">
                        <h2 class="profile-name">Eric Marcelino Hutabarat</h2>
                        <span class="profile-role">Data dan Sistem Analis</span>
                        <div class="my-2">
                            <i class="bi bi-instagram profile-icon"></i>
                            <i class="bi bi-telephone profile-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- website development team section end --}}



    {{-- contact rain section start --}}
    <div id="kontak" class="container-fluid" style="margin-bottom: 15rem;">
        <div class="container">
            <div class="position-relative">
                <h1 class="website-feature-heading">
                    Kontak <span style="color: var(--primary)">RAIN</span>
                </h1>
                <img src="{{ asset('storage/svg/Arrow-13-blue.svg') }}" alt="Blue arrow down ilustration"
                    class="position-absolute" style="top: -15.5rem; left: -3.5rem; aspect-ratio: 1/1; width: 250px;">
                <p style="width: 600px;">Anda memerlukan bantuan atau punya sebuah saran dan pertanyaan? Silahkan ketik
                    dan kirimkan pesan anda melalui kotak pesan dibawah ini!</p>
            </div>
            <div class="container d-flex align-items-center justify-content-center contact-container">
                <img src="{{ asset('storage/svg/contact-ilustration.svg') }}" alt="Contact us ilustration">
                <div>
                    <form id="contact-us-form" method="POST" class="form-contact mx-auto p-4">
                        <input type="email" name="email" class="rounded-pill" id="email"
                            placeholder="email">
                        <textarea name="feedback" id="feedback" class="input-pesan" placeholder="Kirim pesan anda disini"></textarea>
                        <button onclick="sendFeedback()" type="button" class="rounded-pill"
                            name="kirim-pesan">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- contact rain section end --}}



    {{-- footer section start --}}
    <footer id="tentang" class="container-fluid d-flex flex-column align-items-center justify-content-center p-5">
        <div class="d-flex align-items-center justify-content-center" style="margin-bottom: .5rem;">
            <img src="{{ asset('storage/2d-logo.png') }}" alt="RAIN 2D Logo">
            <h1>RAIN</h1>
        </div>
        <p class="mb-4">RAIN adalah aplikasi lowongan magang berbasis web yang dibuat khusus untuk Mahasiswa
            Polibatam.</p>
        <div>
            <a href="" class="bi bi-instagram"></a>
            <a href="" class="bi bi-telephone-fill"></a>
            <a href="" class="bi bi-envelope"></a>
        </div>
    </footer>
    {{-- footer section end --}}


    {{-- pop up notifikasi custom --}}
    <div id="custom-notification"
        class="d-none position-fixed top-0 end-0 start-0 bottom-0 d-flex align-items-center justify-content-center z-1 min-vh-100"
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

    <!-- link boottrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    {{-- jqeury --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('js/index.js') }}"></script>

</body>

</html>
