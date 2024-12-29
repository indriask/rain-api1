$(document).ready(function () {
    // Ambil daftar jurusan dari server
    $.getJSON('/jurusan', function (data) {
        let jurusanSelect = $('#jurusan');
        jurusanSelect.empty().append('<option value="">Pilih jurusan</option>');
        data.forEach(function (jurusan) {
            jurusanSelect.append(`<option value="${jurusan.id}">${jurusan.name}</option>`);
        });
    });

    // Ketika jurusan dipilih, ambil daftar prodi
    $('#jurusan').on('change', function () {
        let idJurusan = $(this).val();
        console.log(idJurusan);
        let prodiSelect = $('#prodi');
        prodiSelect.empty().append('<option value="">Pilih prodi</option>');
        if (idJurusan) {
            $.getJSON(`/prodi/${idJurusan}`, function (data) {
                data.forEach(function (prodi) {
                    prodiSelect.append(
                        `<option value="${prodi.id}">${prodi.name}</option>`);
                });
            });
        }
    });

    $.getJSON('/lokasi', function (data) {
        let lokasiSelect = $('#lokasi');
        lokasiSelect.empty().append('<option value="">Pilih Lokasi</option>');

        data.forEach(function (lokasi) {
            lokasiSelect.append(
                `<option value="${lokasi.lokasi}">${lokasi.lokasi}</option>`);
        });
    });
});

function fetchLowongan() {
    const jurusan = $('#jurusan').val();
    const prodi = $('#prodi').val();
    const modeKerja = $('select[name="mode_kerja"]').val();
    const lokasi = $('#lokasi').val();
    const search = $('input[name="cari-perusahaan"]').val();

    $.ajax({
        url: '/lowongan/filter',
        method: 'GET',
        data: {
            jurusan,
            prodi,
            mode_kerja: modeKerja,
            lokasi,
            search,
        },
        success: function (data) {
            const container = $('#data-lowongan');
            container.empty();
            data.forEach((lowong) => {
                // Memformat tanggal
                const tanggal = new Date(lowong.tanggal_pendaftaran);
                const bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
                    "Agustus", "September", "Oktober", "November", "Desember"
                ];
                const tanggalFormat = ("0" + tanggal.getDate()).slice(-2) + "-" + bulan[tanggal
                    .getMonth()] + "-" + tanggal.getFullYear();

                container.append(`
    <div class="vacancy-card bg-white py-3 px-4">
        <div class="d-flex justify-content-between">
            <h5 class="salary-text">Rp. ${lowong.gaji_perbulan.toLocaleString('id-ID')}/bulan</h5>
            <img class="company-photo rounded" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbgAzqz4kY3Lte8GPpOfYnINyvZhPxXl5uSw&s" alt="Company photo">
        </div>
        <div>
            <h6 class="vacancy-role m-0">${lowong.nama_pekerjaan}</h6>
            <span class="vacancy-major-choice">${lowong.jurusan.name}</span>
            <ul class="vacancy-small-detail p-0 mt-3">
                <li><i class="bi bi-geo-alt me-3"></i>${lowong.lokasi}</li>
                <li><i class="bi bi-calendar3 me-3"></i>${tanggalFormat}</li> <!-- Tanggal yang diformat -->
                <li><i class="bi bi-bar-chart-line me-3"></i>${lowong.jumlah_kouta} Kuota</li>
            </ul>
            <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                <li class="bg-white rounded-pill text-center">${lowong.jenis_kerja}</li>
                <li class="bg-white rounded-pill text-center">${lowong.mode_kerja}</li>
                <li class="bg-white rounded-pill text-center">${lowong.lama_magang} Bulan</li>
            </ul>
            <button onclick="showVacancyDetail('1')"
                class="vacancy-detail border border-0 text-white mx-auto d-block mt">Detail</button>
        </div>
    </div>
`);
            });
        },

    });
}

$('#jurusan, #prodi, select[name="mode_kerja"], #lokasi, input[name="cari-perusahaan"]').on('change keyup',
    fetchLowongan);

$('.hapus-filter').on('click', function () {
    $('#jurusan').val('');
    $('#prodi').val('');
    $('#prodi').find('option').not(':first').remove();
    $('select[name="mode_kerja"]').val('');
    $('#lokasi').val('');
    $('input[name="cari-perusahaan"]').val('');
    fetchLowongan();
});

const vacancyCardListContainer = document.querySelector("#vacancy-card-list-container");
const vacancyDetailCard = $("#vacancy-detail-card");
const vacancyApplyFormContainer = document.querySelector("#vacancy-apply-form-container")
const applyFormNotifcation = document.querySelector("#apply-form-notification");
const vacancyApplyForm = document.querySelector("#vacancy-apply-form");
const vacancyCardList = document.querySelector("#vacancy-card-list");
const logoutCard = document.querySelector("#logout-card");
let selectHide = false;

let addVacancy = document.querySelector("#add-vacancy");
let addVacancyForm = null;
let addVacancyNotification = null;


// function untuk mengambil data lowongan dan menampilkannya
function showVacancyDetailCard(id = 0) {
    const vacancyDetailCard = $("#vacancy-detail-card");

    if (vacancyDetailCard.hasClass("d-block")) {
        vacancyDetailCard.removeClass("d-block");
        vacancyDetailCard.addClass("d-none");

        $("#vacancy-detail-card-info").remove();
        $("#dashboard__not-found-container").remove();
        return 1;
    } else {
        vacancyDetailCard.addClass("d-block");
        vacancyDetailCard.removeClass("d-none");
    }

    $.ajax({
        url: `/dashboard/${id}`,
        method: "GET",
        headers: {
            "X-GET-DATA": "specific-data",
        },
        success: function (response) {
            if (response.vacancy === null || response.vacancy === undefined) {
                vacancyDetailCard.html(`
                     <div id="dashboard__not-found-container">
                    <div class="dashboard__not-found-container rounded border py-3 px-4 bg-white">
                        <div class="mx-auto">
                            <img class="dashboard__not-found-icon d-block mx-auto mb-1"
                                src="${window.storage_path.path}svg/failed-x.svg" alt="">
                            <h4 class="text-center fw-700" style="font-size: 1.35rem;">Oops</h4>
                        </div>
                        <p class="text-center text-body-secondary mb-0">Data tidak ditemukan dengan kriteria ini.</p>
                        <p class="text-center text-body-secondary">Silahkan coba lagi nanti</p>
                        <button
                            class="bni-blue border border-0 text-white rounded click-animation d-block mx-auto p-1 click-animation cursor-pointer"
                            style="width: 90px;" onclick="showVacancyDetailCard()">Tutup</button>
                    </div>
                </div>
                `);
                return false;
            }

            let vacancy = response.vacancy;
            let applyForm = "";
            let fullName = `${vacancy.company.profile.first_name ?? ""} ${vacancy.company.profile.last_name ?? ""}`;

            const formatter = new Intl.NumberFormat('en-us', {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0
            });

            if (fullName.trim() === "") {
                fullName = "Username";
            }

            if (response.role === 'student') {
                applyForm = `
                    <div class="d-flex">
                            <button type="button"
                            class="apply-vacancy-button click-animation border border-0 text-white fw-700 ms-auto"
                            onclick="showApplyVacancyFormContainer(1)">Daftar</button>
                        </div>
                `;
            }

            $("#vacancy-detail-card").append(`
                <div id="vacancy-detail-card-info" class="apply-form bg-white p-4 d-flex gap-4 mt-3">
                    <div class="position-relative w-50">
                        <h1 class="apply-form-title">${vacancy.title}</h1>
                        <div class="d-flex mt-3">
                            <img
                                class="apply-vacancy-img object-fit-cover object-fit-position me-2" src="${window.storage_path.path + vacancy.company.profile.photo_profile}"
                                alt="Company photo">
                            <div style="width: 250px">
                                <div class="apply-company-title d-flex justify-content-between">
                                    <span class="fw-500" style="width: 100px;">${fullName}</span>
                                    <span class="fw-500">${vacancy.location}</span>
                                </div>
                                <div class="apply-vacancy-small-detail d-flex gap-2 mt-1">
                                    <span class="bg-white rounded-pill p-1">${vacancy.time_type}</span>
                                    <span class="bg-white rounded-pill p-1">${vacancy.type}</span>
                                    <span class="bg-white rounded-pill p-1">${vacancy.duration} Bulan</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-input-container mt-4">
                            <label class="fw-500">Gaji</label>
                            <div class="input-group">
                                <div class="box" style="width: 50px;">${formatter.format(vacancy.salary)}</div>
                                <span class="mx-3">/</span>
                                <div class="box" style="width: 30px;">${vacancy.salary === 0 ? "-" : "bulan"}</div>
                            </div>

                            <label class="fw-500">Jurusan</label>
                            <div class="box">${vacancy.major.name}</div>

                            <label class="fw-500">Dibuka</label>
                            <div class="input-group">
                                <div class="box">${vacancy.date_created}</div>
                                <span class="mx-3">-</span>
                                <div class="box">${vacancy.date_ended}</div>
                            </div>

                            <label class="fw-500">Kuota</label>
                            <div class="box">${vacancy.quota}</div>

                            <label class="fw-500">Pendaftar</label>
                            <div class="box">${vacancy.applied}</div>
                        </div>
                        <div class="position-absolute bottom-0">
                            <button onclick="showVacancyDetailCard()" type="button"
                                class="close-apply-form text-white click-animation fw-700 border border-0">Kembali</button>
                        </div>
                    </div>
                    <div class="w-50">
                        ${applyForm}
                        <h5 class="apply-vacancy-detail-lowongan">Detail Lowongan</h5>
                        <div class="apply-vacancy-detail overflow-auto">${vacancy.description}</div>
                    </div>
                </div>    
            
            
            `);

        },
        error: function (jqXHR) {
            if (jqXHR.status === 500) {
                const response = jqXHR.responseJSON.notification;
                showCustomNotification(response.message, response.icon);
                return;
            }

            // error kesalahan pada validasi token CSRF
            if (jqXHR.status === 419) {
                showCustomNotification("Gagal melakukan request, harap coba lagi!", `${window.storage_path.path}svg/failed-x.svg`);
                return;
            }

            // check apakah response code nya 401 (user tidak ter-autentikasi)
            if (jqXHR.status === 401) {
                let currentUrl = window.location.href;
                let currentPath = window.location.pathname;
                let url = currentUrl.split(currentPath);
                url[1] = 'index';

                url = url.join('/');
                window.location.replace(url);
                return false;
            }

            // check apakah response code nya 403 (akses tidak diizinkan)
            if (jqXHR.status === 403) {
                showCustomNotification("Gagal menampilkan halaman website, harap coba lagi!", `${window.storage_path.path}svg/failed-x.svg`);
                return;
            }
        }
    });
}

// function untuk meng-aktifkan dan non-aktifkan form daftar lowongan mahasiswa
function showApplyVacancyFormContainer(id) {
    if (vacancyApplyFormContainer.classList.contains("d-block")) {
        vacancyApplyFormContainer.classList.remove("d-block");
        vacancyApplyFormContainer.classList.add("d-none", "pe-none");
        return 1;
    }

    vacancyApplyFormContainer.classList.remove("d-none", "pe-none");
    vacancyApplyFormContainer.classList.add("d-block");
}

// function untuk mengirim data diri mahasiswa ke server
function processAddProposal(id) {
    showNotification();
}

// function untuk menampilkan notifikasi berhasil atau tidaknya pengirim data diri mahasiswa
function showNotification() {
    applyFormNotifcation.classList.remove("d-none", "pe-none");
    applyFormNotifcation.classList.add("d-block");

    vacancyApplyForm.classList.add("d-none", "pe-none");

    return 1;
}

// menutup semua tampilan form daftar lowongan mahasiswa, notifikasi, dan detail lowongan
function closeAllFormCard() {
    applyFormNotifcation.classList.remove("d-block");
    applyFormNotifcation.classList.add("d-none", "pe-none");

    vacancyApplyForm.classList.remove("d-none", "pe-none");

    showApplyVacancyFormContainer();
    showVacancyDetail();

    return 1;
}

// function untuk menampilkan pesan ingin logout
function showLogoutCard() {
    if (logoutCard.classList.contains("d-block")) {
        logoutCard.classList.remove("d-block");
        logoutCard.classList.add("d-none");

        return;
    }

    logoutCard.classList.remove("d-none");
    logoutCard.classList.add("d-block");
}

// function untuk request logout ke server
function processLogoutRequest() {
    $.ajax({
        url: "/api/signout",
        type: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        success: function (response) {
            if (response.code === 302) {
                $("#logout-card-message").text(response.message);
                $("#logout-card-close-btn").remove();
                $("#logout-card-btn").remove();

                setTimeout(() => window.location.replace('/index'), 500);
            } else {
                $("#logout-card-message").text(response.message);

                setTimeout(() => {
                    $("#logout-card-content").append(`
                         <div id="logout-card-close-btn" class="d-flex">
                            <button onclick="showLogoutCard()"
                                class="dashboard__close-btn ms-auto bni-blue text-white border border-0">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </div>
                        <div class="py-3 px-5">
                            <span id="logout-card-message" class="fw-600 text-center d-block">Apakah anda yakin ingin keluar dari akun ini?</span>
                            <button id="logout-card-btn" onclick="processLogoutRequest()"
                            class="border border-0 bni-blue text-white d-block mx-auto fw-700 mt-4"
                            style="width: 120px; padding: 6px 10px; border-radius: 10px; font-size: .9rem">Keluar</button>
                        </div>
                    `);

                    $("#logout-card").removeClass("d-block");
                    $("#logout-card").addClass("d-none");
                }, 1000);
            }
        },
        error: function (jqXHR) {
            if (jqXHR.status === 500) {
                const response = jqXHR.responseJSON.notification;
                showCustomNotification(response.message, response.icon);
                return;
            }

            // error kesalahan pada validasi token CSRF
            if (jqXHR.status === 419) {
                showCustomNotification("Gagal melakukan request, harap coba lagi!", `${window.storage_path.path}svg/failed-x.svg`);
                return;
            }

            // check apakah response code nya 401 (user tidak ter-autentikasi)
            if (jqXHR.status === 401) {
                let currentUrl = window.location.href;
                let currentPath = window.location.pathname;
                let url = currentUrl.split(currentPath);
                url[1] = 'index';

                url = url.join('/');
                window.location.replace(url);
                return false;
            }

            // check apakah response code nya 403 (akses tidak diizinkan)
            if (jqXHR.status === 403) {
                showCustomNotification("Gagal menampilkan halaman website, harap coba lagi!", `${window.storage_path.path}svg/failed-x.svg`);
                return false;
            }
        }
    });
}

// function untuk menampilkan form tambah lowongan untuk role perusahaan
function showAddVacancyCard() {
    if ($("#add-vacancy").text().trim() !== '') {
        $("#add-vacancy").text("");
        return;
    }

    $("#add-vacancy").html(`
        <div class="position-absolute top-0 end-0 bottom-0 start-0 d-flex justify-content-center position-relative"
        style="background-color: rgba(0, 0, 0, .4)">
        <form method="POST" id="add-vacancy-form" enctype="multipart/form-data"
            class="dashboard__add-vacancy-company bg-white p-4 d-flex align-items-center justify-content-center gap-4 mt-3 position-relative">
            <div id="add-vacancy-input" class="w-50 d-block">
                <div class="dashboard__add-vacancy-form">
                    <label for="gaji" class="fw-600">Gaji</label>
                    <div>
                        <div>
                            <input type="text" id="vacancy-salary" style="width: 120px" class="focus-ring"
                                name="salary">
                            <span class="mx-2">/</span>
                            <div class="d-inline-block">Bulan</div>
                        </div>
                        <div id="input-salary"></div>
                    </div>

                    <label for="judul" class="fw-600">Judul</label>
                    <div class="w-100">
                        <input type="text" class="w-100" name="title" class="focus-ring">
                        <div id="input-title"></div>
                    </div>

                    <label for="major" class="fw-600">Jurusan</label>
                    <div class="w-100">
                        <select name="id_major" id="vacancy-major" class="w-100 focus-ring bg-white border border-0">
                            <option value="3">Teknik Informatika</option>
                            <option value="2">Teknik Elektro</option>
                            <option value="4">Teknik Mesin</option>
                            <option value="1">Manajemen Bisnis</option>
                        </select>
                        <div id="input-major"></div>
                    </div>


                    <label for="lokasi" class="fw-600">Lokasi</label>
                    <div class="w-100">
                        <input type="text" id="vacancy-location" name="location" class="w-100 focus-ring">
                        <div id="input-location"></div>
                    </div>

                    <label for="dibuka" class="fw-600">Dibuka</label>
                    <div>
                        <div>
                            <input type="date" id="vacancy-date-created" style="width: 120px" class="focus-ring"
                                name="date_created">
                            <span class="mx-2">-</span>
                            <input type="date" id="vacancy-date-ended" style="width: 120px;" class="focus-ring"
                                name="date_ended">
                        </div>
                        <div id="input-date"></div>
                    </div>

                    <label for="tipe-waktu" class="fw-600">Tipe waktu</label>
                    <div>
                        <div>
                            <div>
                                <input type="radio" name="time_type" id="full-time" value="full time">
                                <label for="full-time">Full time</label>
                            </div>
                            <div>
                                <input type="radio" name="time_type" value="part time" id="">
                                <label for="part-time">Part time</label>
                            </div>
                            <div id="input-time-type"></div>
                        </div>
                    </div>

                    <label for="jenis" class="fw-600">Jenis</label>
                    <div class="w-100">
                        <select name="type" id="" class="w-100 focus-ring bg-white border border-0">
                            <option value="online">Online</option>
                            <option value="offline">Offline</option>
                            <option value="hybrid">Hybrid</option>
                        </select>
                        <div id="input-type"></div>
                    </div>

                    <label for="durasi" class="fw-600">Durasi</label>
                    <div class="w-100">
                        <input type="text" name="duration" class="focus-ring" style="width: 80px;">
                        <div id="input-duration"></div>
                    </div>

                    <label for="pendaftar" class="fw-600">Quota</label>
                    <div>
                        <input type="text" name="quota" id="" class="focus-ring" style="width: 80px;">
                        <div id="input-quota"></div>
                    </div>
                </div>
            </div>
            <div id="add-vacancy-detail" class="w-50 d-block">
                <label for="detail-lowongan" class="fw-600 d-block">Detail lowongan</label>
                <textarea name="description" id="" class="dashboard__add-vacancy-textarea border border-0 focus-ring p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, natus numquam. Deserunt debitis sequi fugiat unde, natus non corporis dicta! Repudiandae temporibus sapiente hic iste, eaque eveniet a laboriosam iusto impedit totam. Excepturi, quae nesciunt!</textarea>
            </div>
            <div class="position-absolute bottom-0 start-0 end-0 py-3 px-4 d-flex justify-content-between">
                <button class="border border-0 bni-blue click-animation text-white fw-700" onclick="showAddVacancyCard()"
                    type="button">Tutup</button>
                <button id="add-vacancy-submit" class="d-block click-animation border border-0 bni-blue text-white fw-700"
                    onclick="processAddVacancy()" type="button">Ekspos</button>
            </div>
        </form>

        <div id="add-vacancy-notification"
            class="dashboard__add-vacancy-notification d-none position-absolute bg-white p-4 mt-3 d-flex flex-column align-items-center justify-content-center">
            <h5 id="add-vacancy-notification-title" class="fw-700"></h5>
            <img id="add-vacancy-notification-icon" src="" alt="">
            <button class="border border-0 bni-blue text-white fw-700 position-relative"
                onclick="closeAddVacancyForm()">Tutup</button>
        </div>
    </div>
    `);

}

// function untuk mengirim data lowongan baru ke server
function processAddVacancy() {
    const form = new FormData($('#add-vacancy-form').get(0));

    $.ajax({
        url: '/api/dashboard/perusahaan/tambah/lowongan',
        type: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        data: form,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.validation_error) {
                (response.validation_error.salary !== undefined) ? $("#input-salary").html(`<div class="text-danger m-0" style="font-size: .8rem;">${response.validation_error.salary}</div>`) : "";
                (response.validation_error.title !== undefined) ? $("#input-title").html(`<div class="text-danger m-0" style="font-size: .8rem;">${response.validation_error.title}</div>`) : "";
                (response.validation_error.major !== undefined) ? $("#input-major").html(`<div class="text-danger m-0" style="font-size: .8rem;">${response.validation_error.major}</div>`) : "";
                (response.validation_error.location !== undefined) ? $("#input-location").html(`<div class="text-danger m-0" style="font-size: .8rem;">${response.validation_error.location}</div>`) : "";
                (response.validation_error.date_created !== undefined) ? $("#input-date").html(`<div class="text-danger m-0" style="font-size: .8rem;">${response.validation_error.date_created}</div>`) : "";
                (response.validation_error.time_type !== undefined) ? $("#input-time-type").html(`<div class="text-danger m-0" style="font-size: .8rem;">${response.validation_error.time_type}</div>`) : "";
                (response.validation_error.type !== undefined) ? $("#input-type").html(`<div class="text-danger m-0" style="font-size: .8rem;">${response.validation_error.type}</div>`) : "";
                (response.validation_error.duration !== undefined) ? $("#input-duration").html(`<div class="text-danger m-0" style="font-size: .8rem;">${response.validation_error.duration}</div>`) : "";
                (response.validation_error.quota !== undefined) ? $("#input-quota").html(`<div class="text-danger m-0" style="font-size: .8rem;">${response.validation_error.quota}</div>`) : "";

                return false;
            }

            let notification = response.notification;
            console.log(response);
            showAddVacancyNotification(notification.message, notification.icon);
        },
        error: function (jqXHR) {
            if (jqXHR.status === 500) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.message, response.icon);

                return;
            }

            // error kesalahan pada validasi token CSRF
            if (jqXHR.status === 419) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.message, response.icon);

                return;
            }

            // check apakah response code nya 401 (user tidak ter-autentikasi)
            if (jqXHR.status === 401) {
                let currentUrl = window.location.href;
                let currentPath = window.location.pathname;
                let url = currentUrl.split(currentPath);
                url[1] = 'index';

                url = url.join('/');
                window.location.replace(url);
                return false;
            }

            // check apakah response code nya 403 (akses tidak diizinkan)
            if (jqXHR.status === 403) {
                showCustomNotification("Gagal menampilkan halaman website, harap coba lagi!", `${window.storage_path.path}svg/failed-x.svg`);
                return false;
            }

            // error jika akun perusahaan tidak terverifikasi
            if (jqXHR.status === 400) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.message, response.icon);
                return false;
            }
        }
    })
}

// function untuk menampilkan notifikasi berhasil atau tidak tambah lowongan
function showAddVacancyNotification(message, icon) {
    const notificationTitle = $("#add-vacancy-notification-title").get(0);
    const notificationIcon = $("#add-vacancy-notification-icon").get(0);

    notificationTitle.textContent = message;
    notificationIcon.src = icon;

    $("#add-vacancy-notification").removeClass("d-none");
    $("#add-vacancy-notification").addClass("d-block");
}

// function untuk menutup tampilan dan me-reset form input tambah lowongan 
function closeAddVacancyForm() {
    $("#add-vacancy-notification").removeClass("d-block");
    $("#add-vacancy-notification").addClass("d-none");

    $("#add-vacancy-form").get(0).reset();

    $("#add-vacancy").text("");

    return;
}

function showCustomNotification(message, icon) {
    if (daftarPelamarCustomNotification.hasClass("d-block")) {
        daftarPelamarCustomNotification.removeClass("d-block");
        daftarPelamarCustomNotification.addClass("d-none");

        return;
    }

    console.log(icon);
    daftarPelamarCustomNotification.removeClass("d-none");
    daftarPelamarCustomNotification.addClass("d-block");

    $("#custom-notification-message").text(message);
    $("#custom-notification-icon").attr('src', icon);
}

function closeFilter() {
    $("div.select-container > div.select-container").toggle();
    if(selectHide) {
        selectHide = false;
        $("#filter-btn-text").text("Hapus Filter");
    } else {
        selectHide = true;
        $("#filter-btn-text").text("Buka Filter");
    }
}