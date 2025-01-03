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

        {{-- dashboard navbar samping kanan --}}
        <x-dashboard-navbar :role="$role" />

        {{-- content dashboard utama --}}
        <main class="dashboard-main position-relative p-4">

            {{-- photo profile dan nama mahasiswa --}}
            <div class="dashboard-main-nav border-bottom border-black px-5 py-2">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center gap-1 mb-2">
                        <img src="{{ asset('storage/' . $profile->photo_profile) }}" alt=""
                            class="profile-img rounded-circle shadow">
                        <span class="profile-name">{{ $fullName }}</span>
                    </div>
                </div>
            </div>

            {{-- notifikasi sukses edit profile --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            {{-- form edit profile mahasiswa --}}
            <div class="mx-auto d-flex h-100 gap-5 mt-4" style="width: calc(100% - 50px)">
                <div class="profile-info w-50 position-relative">
                    <div class="d-flex align-items-center gap-3">
                        <label for="input-photo-profile" class="cursor-pointer">
                            <img src="{{ asset('storage/' . $profile->photo_profile) }}" alt="Someone profile"
                                class="profile__profile-img rounded">
                        </label>
                        <div class="w-100">
                            <input type="text" form="edit-profile-form" value="{{ $fullName }}" readonly
                                class="profile__profile-nama-lengkap border focus-ring border-0 bg-white rounded p-2 w-100">
                            <span class="fw-700 d-block" style="font-size: .9rem">Mahasiswa</span>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('student.updateProfile') }}" id="edit-profile-form"
                        class="profile__profile-more-info mt-3 p-2 overflow-y-auto" style="height: 360px;"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="file" hidden id="input-photo-profile" name="photo-profile"
                            onchange="handleProfileFile()">
                        <input type="text" hidden id="input-old-photo-profile" name="old-photo-profile"
                            value="{{ $profile->photo_profile }}">

                        <label for="asal-institusi" style="font-size: .95rem">NIM</label>
                        <input type="text" readonly disabled value="{{ auth('web')->user()->student->nim ?? '' }}"
                            class="profile__profile-nama-lengkap focus-ring border border-0 bg-white rounded p-2 w-100"
                            placeholder="NIM">

                        <label for="asal-institusi" style="font-size: .95rem">First Name</label>
                        <input type="text" name="first_name" value="{{ $profile->first_name ?? '' }}"
                            class="profile__profile-nama-lengkap focus-ring border border-0 bg-white rounded p-2 w-100"
                            placeholder="First Name">

                        <label for="asal-institusi" style="font-size: .95rem">Last Name</label>
                        <input type="text" name="last_name" value="{{ $profile->last_name ?? '' }}"
                            class="profile__profile-nama-lengkap focus-ring border border-0 bg-white rounded p-2 w-100 "
                            placeholder="Last Name">

                        <label for="asal-institusi" style="font-size: .95rem">Asal institusi</label>
                        <input type="text" name="institute" class="border border-0 rounded p-1 px-2 focus-ring"
                            value="{{ $student->institute ?? '' }}">

                        <label for="jurusan" style="font-size: .95rem">Jurusan</label>
                        <select name="major" id="major"
                            class="border border-0 rounded p-1 px-2 focus-ring bg-white">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($major as $item)
                                <option value="{{ $item->id }}"
                                    {{ $student->id_major == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>

                        <label for="jurusan" style="font-size: .95rem">Program Studi</label>
                        <select name="study_program" id="study_program"
                            class="border border-0 rounded p-1 px-2 focus-ring bg-white">
                            <option value="">Pilih Program Studi</option>
                            @foreach ($study_program as $item)
                                <option value="{{ $item->id }}"
                                    {{ $student->id_study_program == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>


                        <label for="keahlian" style="font-size: .95rem">Keahlian</label>
                        <input type="text" name="skill" class="border border-0 rounded p-1 px-2 focus-ring"
                            value="{{ $student->skill ?? '' }}">

                        <label for="alamat" style="font-size: .95rem">Alamat</label>
                        <input type="text" name="location" class="border border-0 rounded p-1 px-2 focus-ring"
                            value="{{ $profile->location ?? '' }}">

                        <label for="kota" style="font-size: .95rem">Kota</label>
                        <input type="text" name="city" class="border border-0 rounded p-1 px-2 focus-ring"
                            value="{{ $profile->city ?? '' }}">

                        <label for="kode-pos" style="font-size: .95rem">Kode Pos</label>
                        <input type="text" name="postal_code" class="border border-0 rounded p-1 px-2 focus-ring"
                            value="{{ $profile->postal_code ?? '' }}">

                        <label for="nomor-telepon" style="font-size: .95rem">Nomor telepon</label>
                        <input type="text" name="phone_number" class="border border-0 rounded p-1 px-2 focus-ring"
                            value="{{ $profile->phone_number ?? '' }}">

                        <label for="email" style="font-size: .95rem">Email</label>
                        <input type="text" name="email" class="border border-0 rounded p-1 px-2 focus-ring"
                            value="{{ $user->email ?? '' }}" readonly>


                        <div class="position-absolute gap-2" style="bottom: 10px;">
                            <button type="button"
                                class="border border-0 bni-blue click-animation text-white fw-700 p-1 rounded"
                                style="font-size: .9rem; width: 100px;"
                                onclick="window.location.href='{{ route('dashboard') }}'">Kembali</button>
                            <button type="button" onclick="showDeleteAccountCard()"
                                class="border border-0 bni-blue text-white click-animation fw-700 p-1 rounded"
                                style="font-size: .9rem; width: 100px;">Hapus akun</button>
                        </div>
                </div>
                <div class="profile__profile-description w-50">
                    <div class="d-flex">
                        <button type="submit"
                            class="border border-0 bni-blue text-white click-animation fw-700 rounded p-2 ms-auto"
                            style="font-size: .8rem; width: 100px;" id="edit-profile-btn">
                            Edit Profil
                        </button>

                    </div>
                    <div class="h-100">
                        <span class="fw-700 mb-2 d-block" style="font-size: .9rem">Deskripsi Profil Mahasiswa</span>
                        <textarea name="description" form="edit-profile-form"
                            class="bg-white shadow overflow-auto px-3 py-2 focus-ring border border-0 w-100"
                            style="font-size: .9rem; height: 435px; text-align: justify; line-height: 1.5rem; border-radius: 20px;">{{ $profile->description ?? '' }}</textarea>
                    </div>
                </div>
                </form>
            </div>

            {{-- pop up pesan notifikasi berhasil atau gagal edit --}}
            <div id="edit-profile-notification"
                class="d-none position-absolute top-0 end-0 bottom-0 start-0 d-flex align-items-center justify-content-center"
                style="background-color: rgba(0, 0, 0, .4)">
                <div
                    class="profile__profile-edit-notification bg-white p-5 d-flex justify-content-center align-items-center position-relative">
                    <div>
                        <h5 id="profile-edit-notification-title" class="fw-700 text-center">Profile berhasil
                            diperbaharui!</h5>
                        <button onclick="showEditProfileNotification()"
                            class="profile__profile-edit-notification-btn border border-0 bni-blue fw-700 text-white d-block mx-auto mt-4">Kembali</button>
                    </div>
                    <img id="profile-edit-notification-img" src="{{ asset('storage/svg/success-checkmark.svg') }}"
                        alt="" class="profile__profile-success-edit-icon position-absolute">
                </div>
            </div>

            {{-- pop up pesan notifikasi ingin menghapus akun --}}
            <div id="delete-account-notification"
                class="d-none position-absolute top-0 end-0 start-0 bottom-0 d-flex align-items-center justify-content-center"
                style="background-color: rgba(0, 0, 0, .4)">
                <div class="profile__profile-delete-account bg-white">
                    <div class="d-flex">
                        <button onclick="showDeleteAccountCard()"
                            class="profile__profile-close-btn click-animation ms-auto bni-blue text-white border border-0">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </div>
                    <div class="py-3 px-5">
                        <span class="fw-600">Apakah anda yakin ingin menghapus akun ini?</span>
                        <button onclick="processDeleteAccountRequest()"
                            class="border border-0 bni-blue text-white d-block click-animation mx-auto fw-700 mt-4"
                            style="width: 120px; padding: 6px 10px; border-radius: 10px; font-size: .9rem">Hapus</button>
                    </div>
                </div>

            </div>

            {{-- pop up notifikasi custom --}}
            <div id="custom-notification"
                class="d-none position-absolute top-0 end-0 z-1 bottom-0 start-0 d-flex align-items-center justify-content-center"
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

    {{-- script js buat logika fitur umum pada dashboard mahasiswa, perusahaan dan admin --}}
    <script src="{{ asset('js/dashboard.js') }}"></script>

    {{-- script js buat logika fitur dashboard profile mahasiswa --}}
    <script src="{{ asset('js/student/profile.js') }}"></script>

    {{-- <script>
        function processDeleteAccountRequest() {
            const confirmed = confirm("Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.");
            if (confirmed) {
                $.ajax({
                    url: '/delete-account', // Ganti dengan route yang sesuai
                    type: 'POST',
                    data: {
                        _token: window.laravel.csrf_token // Ambil CSRF token dari meta/script di template
                    },
                    success: function(response) {
                        alert("Akun berhasil dihapus.");
                        window.location.href = '/'; // Redirect ke halaman utama setelah penghapusan
                    },
                    error: function(error) {
                        alert("Gagal menghapus akun. Silakan coba lagi.");
                        console.error(error);
                    }
                });
            }
        }

        function showDeleteAccountCard() {
            const deleteAccountNotification = document.getElementById('delete-account-notification');

            // Toggle visibility
            if (deleteAccountNotification.classList.contains('d-none')) {
                deleteAccountNotification.classList.remove('d-none');
            } else {
                deleteAccountNotification.classList.add('d-none');
            }
        }
    </script> --}}

    <script>
        // Event listener for the major dropdown
        document.getElementById('major').addEventListener('change', function() {
            const majorId = this.value; // Get the selected major ID

            // If no major is selected, clear the study program dropdown
            if (!majorId) {
                document.getElementById('study_program').innerHTML =
                    '<option value="">Pilih Program Studi</option>';
                return;
            }

            // Fetch the study programs based on the selected major
            fetch(`/get-study-programs/${majorId}`)
                .then(response => response.json())
                .then(data => {
                    const studyProgramDropdown = document.getElementById('study_program');
                    studyProgramDropdown.innerHTML =
                        '<option value="">Pilih Program Studi</option>'; // Reset the dropdown

                    // Populate the study program dropdown with the fetched data
                    data.forEach(program => {
                        const option = document.createElement('option');
                        option.value = program.id;
                        option.textContent = program.name;
                        studyProgramDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching study programs:', error);
                });
        });
    </script>

    @if (session('profile_updated'))
        <script>
            window.onload = function() {
                // Set profile edit notification title and image
                profileEditNotificationTitle.textContent = "Profil berhasil diperbarui!";
                profileEditNotificationImg.src = "{{ asset('storage/svg/success-checkmark.svg') }}";

                // Show the success notification
                showEditProfileNotification();
            };
        </script>
    @endif


</body>

</html>
