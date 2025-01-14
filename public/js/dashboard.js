$(document).ready(function () {
    // Ambil daftar jurusan dari lowongan yang tersedia
    $.getJSON('/jurusan', function (data) {
        let jurusanSelect = $('#jurusan');
        jurusanSelect.empty().append('<option value="">Pilih jurusan</option>');
        data.forEach(function (jurusan) {
            jurusanSelect.append(`<option value="${jurusan.id}">${jurusan.name}</option>`);
        });
    });

    // ambil data lokasi dari lowongan yang tersedia
    $.getJSON('/lokasi', function (data) {
        let lokasiSelect = $('#lokasipekerjaan');
        lokasiSelect.empty().append('<option value="">Pilih Lokasi</option>');

        data.forEach(function (lokasi) {
            lokasiSelect.append(
                `<option value="${lokasi.location}">${lokasi.location}</option>`);
        });
    });

    // mengambil data filter pada filter berbasis mode kerja
    $('#mode_kerja').on('change', function () {
        const selectedTitle = $(this).val();

        $.ajax({
            url: '/filter-vacancies-by-title',
            type: 'GET',
            data: {
                title: selectedTitle
            },
            success: function (response) {
                $('#data-lowongan').empty();

                if (response.length > 0) {
                    response.forEach(function (vacancy) {
                        const card = `
                        <div class="vacancy-card bg-white py-3 px-4">
                            <div class="d-flex justify-content-between">
                                <h5 class="salary-text">Rp. ${new Intl.NumberFormat('id-ID').format(vacancy.salary)}/bulan</h5>
                                <img class="company-photo rounded"
                                    src="${window.storage_path.path + vacancy.photo_profile}"
                                    alt="Company photo">
                            </div>
                            <div>
                                <h6 class="vacancy-role m-0">${vacancy.title}</h6>
                                <span class="vacancy-major-choice">${vacancy.major_name}</span>
                                <ul class="vacancy-small-detail p-0 mt-3">
                                    <li><i class="bi bi-geo-alt me-3"></i>${vacancy.vacancy_location}</li>
                                    <li><i class="bi bi-calendar3 me-3"></i>${new Date(vacancy.date_created).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</li>
                                    <li><i class="bi bi-bar-chart-line me-3"></i>${vacancy.quota} Kuota</li>
                                </ul>
                                <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                    <li class="bg-white rounded-pill text-center">${vacancy.vacancy_type}</li>
                                    <li class="bg-white rounded-pill text-center">${vacancy.time_type}</li>
                                    <li class="bg-white rounded-pill text-center">${vacancy.duration} Bulan</li>
                                </ul>
                                <button onclick="showVacancyDetailCard('${vacancy.id_vacancy}')"
                                    class="vacancy-detail border border-0 click-animation text-white mx-auto d-block mt">Lihat</button>
                            </div>
                        </div>
                    `;
                        $('#data-lowongan').append(card);
                    });
                } else {
                    $('#data-lowongan').html(
                        '<p class="text-center">Tidak ada lowongan ditemukan.</p>');
                }
            },
            error: function () {
                console.error('Terjadi kesalahan saat memuat data.');
            }
        });
    });

    // mengambil data filter pada filter berbasis jurusan
    $('#jurusan2').on('change', function () {
        const selectedMajor = $(this).val();

        $.ajax({
            url: '/filter-vacancies-by-major',
            type: 'GET',
            data: {
                major: selectedMajor
            },
            success: function (response) {
                $('#data-lowongan').empty();

                if (response.length > 0) {
                    response.forEach(function (vacancy) {
                        const card = `
                            <div class="vacancy-card bg-white py-3 px-4">
                                <div class="d-flex justify-content-between">
                                    <h5 class="salary-text">Rp. ${new Intl.NumberFormat('id-ID').format(vacancy.salary)}/bulan</h5>
                                    <img class="company-photo rounded"
                                        src="${window.storage_path.path + vacancy.photo_profile}"
                                        alt="Company photo">
                                </div>
                                <div>
                                    <h6 class="vacancy-role m-0">${vacancy.title}</h6>
                                    <span class="vacancy-major-choice">${vacancy.major_name}</span>
                                    <ul class="vacancy-small-detail p-0 mt-3">
                                        <li><i class="bi bi-geo-alt me-3"></i>${vacancy.vacancy_location}</li>
                                        <li><i class="bi bi-calendar3 me-3"></i>${new Date(vacancy.date_created).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</li>
                                        <li><i class="bi bi-bar-chart-line me-3"></i>${vacancy.quota} Kuota</li>
                                    </ul>
                                    <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                        <li class="bg-white rounded-pill text-center">${vacancy.vacancy_type}</li>
                                        <li class="bg-white rounded-pill text-center">${vacancy.time_type}</li>
                                        <li class="bg-white rounded-pill text-center">${vacancy.duration} Bulan</li>
                                    </ul>
                                    <button onclick="showVacancyDetailCard('${vacancy.id_vacancy}')"
                                        class="vacancy-detail border click-animation border-0 text-white mx-auto d-block mt">Lihat</button>
                                </div>
                            </div>
                        `;
                        $('#data-lowongan').append(card);
                    });
                } else {
                    $('#data-lowongan').html(
                        '<p class="text-center">Tidak ada lowongan ditemukan untuk jurusan ini.</p>'
                    );
                }
            },
            error: function () {
                console.error('Terjadi kesalahan saat memuat data.');
            }
        });
    });

    // mengambil data filter pada filter berbasis lokasi magang
    $('#lokasipekerjaan').on('change', function () {
        const selectedLocation = $(this).val();

        $.ajax({
            url: '/filter-vacancies-by-location',
            type: 'GET',
            data: {
                location: selectedLocation
            },
            success: function (response) {
                $('#data-lowongan').empty();

                if (response.length > 0) {
                    response.forEach(function (vacancy) {
                        const card = `
                        <div class="vacancy-card bg-white py-3 px-4">
                            <div class="d-flex justify-content-between">
                                <h5 class="salary-text">Rp. ${new Intl.NumberFormat('id-ID').format(vacancy.salary)}/bulan</h5>
                                <img class="company-photo rounded"
                                    src="${window.storage_path.path + vacancy.photo_profile}"
                                    alt="Company photo">
                            </div>
                            <div>
                                <h6 class="vacancy-role m-0">${vacancy.title}</h6>
                                <span class="vacancy-major-choice">${vacancy.major_name}</span>
                                <ul class="vacancy-small-detail p-0 mt-3">
                                    <li><i class="bi bi-geo-alt me-3"></i>${vacancy.vacancy_location}</li>
                                    <li><i class="bi bi-calendar3 me-3"></i>${new Date(vacancy.date_created).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</li>
                                    <li><i class="bi bi-bar-chart-line me-3"></i>${vacancy.quota} Kuota</li>
                                </ul>
                                <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                    <li class="bg-white rounded-pill text-center">${vacancy.vacancy_type}</li>
                                    <li class="bg-white rounded-pill text-center">${vacancy.time_type}</li>
                                    <li class="bg-white rounded-pill text-center">${vacancy.duration} Bulan</li>
                                </ul>
                                <button onclick="showVacancyDetailCard('${vacancy.id_vacancy}')"
                                    class="vacancy-detail border border-0 click-animation text-white mx-auto d-block mt">Lihat</button>
                            </div>
                        </div>
                    `;
                        $('#data-lowongan').append(card);
                    });
                } else {
                    $('#data-lowongan').html(
                        '<p class="text-center">Tidak ada lowongan ditemukan untuk lokasi ini.</p>'
                    );
                }
            },
            error: function () {
                console.error('Terjadi kesalahan saat memuat data.');
            }
        });
    });

    // menghapus filter aktif pada lowongan
    $('.hapus-filter').on('click', function () {
        $('#lokasipekerjaan').val('');
        $('#mode_kerja').val('');
        $('#jurusan2').val('');

        $.ajax({
            url: '/filter-vacancies-clear',
            type: 'GET',
            success: function (response) {
                $('#data-lowongan').empty();

                if (response.length > 0) {
                    response.forEach(function (vacancy) {
                        const card = `
                        <div class="vacancy-card bg-white py-3 px-4">
                            <div class="d-flex justify-content-between">
                                <h5 class="salary-text">Rp. ${new Intl.NumberFormat('id-ID').format(vacancy.salary)}/bulan</h5>
                                <img class="company-photo rounded"
                                    src="${window.storage_path.path + vacancy.photo_profile}"
                                    alt="Company photo">
                            </div>
                            <div>
                                <h6 class="vacancy-role m-0">${vacancy.title}</h6>
                                <span class="vacancy-major-choice">${vacancy.major_name}</span>
                                <ul class="vacancy-small-detail p-0 mt-3">
                                    <li><i class="bi bi-geo-alt me-3"></i>${vacancy.vacancy_location}</li>
                                    <li><i class="bi bi-calendar3 me-3"></i>${new Date(vacancy.date_created).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</li>
                                    <li><i class="bi bi-bar-chart-line me-3"></i>${vacancy.quota} Kuota</li>
                                </ul>
                                <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                    <li class="bg-white rounded-pill text-center">${vacancy.vacancy_type}</li>
                                    <li class="bg-white rounded-pill text-center">${vacancy.time_type}</li>
                                    <li class="bg-white rounded-pill text-center">${vacancy.duration} Bulan</li>
                                </ul>
                                <button onclick="showVacancyDetailCard('${vacancy.id_vacancy}')"
                                    class="vacancy-detail border click-animation border-0 text-white mx-auto d-block mt">Lihat</button>
                            </div>
                        </div>
                    `;
                        $('#data-lowongan').append(card);
                    });
                } else {
                    $('#data-lowongan').html(
                        '<p class="text-center">Tidak ada lowongan tersedia.</p>');
                }
            },
            error: function () {
                console.error('Terjadi kesalahan saat memuat data.');
            }
        });
    });

    // request search data ke backend route
    $('#search-lowongan').on('input', function () {
        console.log($('#search-lowongan'));
        console.log($('#data-lowongan .vacancy-card'));


        var searchText = $(this).val()
            .toLowerCase();

        $('#data-lowongan .vacancy-card').each(function () {
            var title = $(this).find('.vacancy-role').text()
                .toLowerCase();

            if (title.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});

const vacancyDetailCard = $("#vacancy-detail-card");
const vacancyApplyFormContainer = $("#vacancy-apply-form-container")
const applyFormNotifcation = $("#apply-form-notification");
const vacancyApplyForm = $("#vacancy-apply-form");
const logoutCard = $("#logout-card");
const dashboardCustomNotification = $("#custom-notification");
let selectHide = false;
let uploadedFiles = 0;
let filesUploaded = null;

const FILE_ICON = {
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document': 'bi-file-earmark-word-fill',
    'application/pdf': 'bi-file-earmark-pdf-fill'
};

let resumeDisplayWrapper = null;
let uploadResumeBtn = null;
let uploadResumeInput = null;

function closeFilter() {
    $("div.select-container > div.select-container").toggle();
    if (selectHide) {
        selectHide = false;
        $("#filter-btn-text").text("Hapus Filter");
    } else {
        selectHide = true;
        $("#filter-btn-text").text("Buka Filter");
    }
}

// function untuk mengambil data lowongan dan menampilkannya
function showVacancyDetailCard(id = 0) {
    if (vacancyDetailCard.hasClass("d-block")) {
        vacancyDetailCard.removeClass("d-block");
        vacancyDetailCard.addClass("d-none");

        $("#vacancy-detail-card-info").remove();
        return 1;
    }

    vacancyDetailCard.addClass("d-block");
    vacancyDetailCard.removeClass("d-none");

    $.ajax({
        url: `/dashboard/${id}`,
        method: "GET",
        success: function (response) {
            const vacancy = response.additional.vacancy;
            let applyForm = "";
            let deleteBtn = "";
            let fullName = `${vacancy.company.profile.first_name ?? ""} ${vacancy.company.profile.last_name ?? ""}`;
            fullName = fullName.trim() === "" ? "Username" : fullName;

            const formatter = new Intl.NumberFormat('en-us', {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0
            });

            const dateCreated = new Date(vacancy.date_created);
            const formattedDateCreated = `${dateCreated.getDate()} ${dateCreated.toLocaleString('en-US', { month: 'short' })} ${dateCreated.getFullYear()}`;
            const dateEnded = new Date(vacancy.date_ended);
            const formattedDateEnded = `${dateEnded.getDate()} ${dateEnded.toLocaleString('en-US', { month: 'short' })} ${dateEnded.getFullYear()}`;
            const endedDateTime = dateEnded.getTime();
            const currentDate = Date.now();
            let status = '';

            if (currentDate > endedDateTime || currentDate < dateCreated) {
                status = 'Ditutup';
            } else {
                status = 'Dibuka';
            }

            switch (response.additional.role) {
                case "student":
                    applyForm = `
                    <div class="d-flex">
                            <button type="button"
                            class="apply-vacancy-button click-animation border border-0 text-white fw-700 ms-auto"
                            onclick="showApplyVacancyFormContainer(${vacancy.id_vacancy})">Daftar</button>
                    </div>
                `;
                    break;

                case "admin":
                    deleteBtn = `
                        <button onclick="adminDeleteVacancy(${vacancy.id_vacancy})" type="button"
                            class="close-apply-form text-white click-animation fw-700 border border-0 ms-1">Hapus</button>
                        `;
                    break;
            }

            $("#vacancy-detail-card").html(`
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
                                <div class="box">${formattedDateCreated}</div>
                                <span class="mx-3">-</span>
                                <div class="box">${formattedDateEnded}</div>
                            </div>

                            <label class="fw-500">Status</label>
                            <div class="box">${status}</div>

                            <label class="fw-500">Kuota</label>
                            <div class="box">${vacancy.quota}</div>

                            <label class="fw-500">Pendaftar</label>
                            <div class="box">${vacancy.applied}</div>
                        </div>
                        <div class="position-absolute bottom-0">
                            <button onclick="showVacancyDetailCard()" type="button"
                                class="close-apply-form text-white click-animation fw-700 border border-0">Kembali</button>
                            ${deleteBtn}
                        </div>
                    </div>
                    <div class="w-50">
                        ${applyForm}
                        <h5 class="apply-vacancy-detail-lowongan">Detail Lowongan</h5>
                        <textarea readonly class="apply-vacancy-detail w-100">${vacancy.description ?? ''}</textarea>
                    </div>
                </div>    
            `);
        },
        error: function (jqXHR) {
            // error untuk kesalahaan server
            if (jqXHR.status === 500) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.title, response.message, response.icon);
                vacancyDetailCard.removeClass("d-block");
                vacancyDetailCard.addClass("d-none");

                return;
            }

            // error kesalahan pada validasi token CSRF
            if (jqXHR.status === 419) {
                showCustomNotification("Request ditolak", "Request yang dikirim telah kadaluarsa", window.storage_path.path + 'svg/failed-x.svg');
                vacancyDetailCard.removeClass("d-block");
                vacancyDetailCard.addClass("d-none");

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

                return;
            }

            // check apakah response code nya 403 (akses tidak diizinkan)
            if (jqXHR.status === 403) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.title, response.message, response.icon);
                vacancyDetailCard.removeClass("d-block");
                vacancyDetailCard.addClass("d-none");

                return;
            }
        }
    });
}

// function untuk meng-aktifkan dan non-aktifkan form daftar lowongan mahasiswa
function showApplyVacancyFormContainer(id) {
    if (vacancyApplyFormContainer.hasClass("d-block")) {
        vacancyApplyFormContainer.removeClass("d-block");
        vacancyApplyFormContainer.addClass("d-none");

        vacancyApplyForm.html('');
        return 1;
    }

    vacancyApplyFormContainer.removeClass("d-none");
    vacancyApplyFormContainer.addClass("d-block");

    $.ajax({
        url: '/get-student-profile',
        method: "GET",
        headers: { "X-GET-DATA": 'get-student-profile-data' },
        success: function (response) {
            let fullName = (response.student.profile.first_name ?? 'Username') + ' ' + response.student.profile.last_name;;

            vacancyApplyForm.html(`
                <form id="student-apply-vacancy" method="POST" class="vacancy-apply-form-card bg-white p-4"
                        enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="${window.laravel.csrf_token}">
                        <div class="d-flex justify-content-between">
                            <h1 class="vacancy-apply-form-card-title fw-700 mb-0">Formulir Lamaran</h1>
                            <button type="button"
                                class="border border-0 bg-transparent click-animation cursor-pointer"
                                onclick="showApplyVacancyFormContainer()"><i class="bi bi-x-circle"></i></button>
                        </div>
                        <span class="vacancy-apply-form-card-small-info">Silahkan mengisi formulir dibawah ini dengan
                            ketentuan berikut</span>

                        <div class="apply-form-common-info mt-4">
                            <h5 class="apply-form-common-info-heading fw-700 mb-3">Informasi dasar</h5>
                            <input type="text" class="w-100 border focus-ring mb-3" placeholder="Username"
                                readonly value="${fullName}">
                            <input type="text" class="w-100 border focus-ring mb-3" placeholder="NIM" readonly
                                value="${response.student.nim ?? ''}">
                            <input type="text" class="w-100 border focus-ring mb-3" placeholder="Jurusan" readonly
                                value="${response.student?.major?.name ?? ''}">
                            <input type="text" class="w-100 border focus-ring mb-3" placeholder="Program Studi"
                                readonly value="${response.student?.study_program?.name ?? ''}">
                            <input type="text" class="w-100 border focus-ring mb-3" placeholder="Email" readonly
                                value="${response.email}">
                            <input type="text" class="w-100 border focus-ring mb-3" placeholder="Nomor Telepon"
                                readonly value="${response.student.profile.phone_number ?? ''}">
                        </div>

                        <h5 class="apply-form-common-info-heaing fw-700 mb-0">Informasi Tambahan</h5>
                        <div class="apply-form-upload-file-info d-flex justify-content-between">
                            <span>Dapat berupa CV atau dokumen lainnya</span>
                            <span>Maks. 6 Dokumen</span>
                        </div>
                        <div id="resume-display-wrapper" class="d-none rounded bg-body-secondary p-2 px-3 d-flex flex-column gap-2">
                        </div>
                        <label for="upload-resume-input" id="upload-resume-btn"
                            class="apply-form-upload-file mt-1 text-white fw-700 text-center w-100 cursor-pointer">
                            <i class="bi bi-plus-square me-1"></i>Tambahkan PDF atau docx
                        </label>
                        <input onchange="displayResumeFile()" type="file" id="upload-resume-input" name="" multiple="true" id="upload-file" hidden>

                        <input type="hidden" name="id_vacancy" value="" id="daftar-lowongan-id-vacancy">

                        <button type="button" onclick="applyVacancy()"
                            class="apply-form-common-info-btn border border-0 click-animation text-white fw-700 d-block mx-auto mt-2 text-center">Kirim</button>
                    </form>   
            `);

            $("#daftar-lowongan-id-vacancy").val(id);
            resumeDisplayWrapper = $("#resume-display-wrapper");
            uploadResumeBtn = $("#upload-resume-btn");
            uploadResumeInput = $("#upload-resume-input");
        },
        error: function (jqXHR) {
            // error untuk kesalahaan server
            if (jqXHR.status === 500) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.title, response.message, response.icon);
                vacancyApplyFormContainer.removeClass("d-block");
                vacancyApplyFormContainer.addClass("d-none");

                return;
            }

            // error kesalahan pada validasi token CSRF
            if (jqXHR.status === 419) {
                showCustomNotification("Request ditolak", "Request yang dikirim telah kadaluarsa", window.storage_path.path + 'svg/failed-x.svg');
                vacancyApplyFormContainer.removeClass("d-block");
                vacancyApplyFormContainer.addClass("d-none");

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

                return;
            }

            // check apakah response code nya 403 (akses tidak diizinkan)
            if (jqXHR.status === 403) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.title, response.message, response.icon);
                vacancyApplyFormContainer.removeClass("d-block");
                vacancyApplyFormContainer.addClass("d-none");

                return;
            }
        }
    });
}

// function untuk mengirim data diri mahasiswa ke server
function processAddProposal(id) {
    showNotification();
}

// function untuk menampilkan notifikasi berhasil atau tidaknya pengirim data diri mahasiswa
function showNotification() {
    applyFormNotifcation.removeClass("d-none", "pe-none");
    applyFormNotifcation.addClass("d-block");

    vacancyApplyForm.addClass("d-none", "pe-none");

    return 1;
}

// menutup semua tampilan form daftar lowongan mahasiswa, notifikasi, dan detail lowongan
function closeAllFormCard() {
    applyFormNotifcation.removeClass("d-block");
    applyFormNotifcation.addClass("d-none", "pe-none");

    vacancyApplyForm.removeClass("d-none", "pe-none");

    showApplyVacancyFormContainer();
    showVacancyDetail();

    return 1;
}

// function untuk menampilkan pesan ingin logout
function showLogoutCard() {
    if (logoutCard.hasClass("d-block")) {
        logoutCard.removeClass("d-block");
        logoutCard.addClass("d-none");

        return;
    }

    logoutCard.removeClass("d-none");
    logoutCard.addClass("d-block");
}

// function untuk request logout ke server
function processLogoutRequest() {
    $.ajax({
        url: "/api/signout",
        type: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        success: function (response) {
            if (response.additional.code === 302) {
                const notification = response.notification;
                showCustomNotification(notification.title, notification.message, notification.icon);
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
            // error untuk kesalahaan server
            if (jqXHR.status === 500) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.title, response.message, response.icon);

                return;
            }

            // error kesalahan pada validasi token CSRF
            if (jqXHR.status === 419) {
                showCustomNotification("Request ditolak", "Request yang dikirim telah kadaluarsa", window.storage_path.path + 'svg/failed-x.svg');

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

                return;
            }

            // check apakah response code nya 403 (akses tidak diizinkan)
            if (jqXHR.status === 403) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.title, response.message, response.icon);

                return;
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
                <textarea name="description" id="" class="dashboard__add-vacancy-textarea border border-0 focus-ring p-3" style="text-align: initial;"></textarea>
                <div id="input-description"></div>
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
                (response.validation_error.description !== undefined) ? $("#input-description").html(`<div class="text-danger m-0" style="font-size: .8rem;">${response.validation_error.description}</div>`) : "";

                return false;
            }

            let notification = response.notification;
            showAddVacancyNotification(notification.message, notification.icon);
        },
        error: function (jqXHR) {
            if (jqXHR.status === 500) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.title, response.message, response.icon);

                return;
            }

            // error kesalahan pada validasi token CSRF
            if (jqXHR.status === 419) {
                showCustomNotification("Request ditolak", "Request yang dikirim telah kadaluarsa", window.storage_path.path + 'svg/failed-x.svg');

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

                return;
            }

            // check apakah response code nya 403 (akses tidak diizinkan)
            if (jqXHR.status === 403) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.title, response.message, response.icon);
                return;
            }

            // error jika akun perusahaan tidak terverifikasi
            if (jqXHR.status === 400) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.title, response.message, response.icon);

                return;
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

function adminDeleteVacancy(id_vacancy) {
    $.ajax({
        url: '/api/dashboard/admin/kelola/lowongan/delete',
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        data: { id_vacancy: id_vacancy },
        success: function (response) {
            if (response.success) {
                let notification = response.notification;
                showCustomNotification('', notification.message, notification.icon);
                return;
            } else {
                let notification = response.notification;
                showCustomNotification(notification.title, notification.message, notification.icon);
                return;
            }
        },
        error: function (jqXHR) {
            if (jqXHR.status === 500) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.title, response.message, response.icon);

                return;
            }

            // error kesalahan pada validasi token CSRF
            if (jqXHR.status === 419) {
                showCustomNotification("Request ditolak", "Request yang dikirim telah kadaluarsa", window.storage_path.path + 'svg/failed-x.svg');

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

                return;
            }

            // check apakah response code nya 403 (akses tidak diizinkan)
            if (jqXHR.status === 403) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.title, response.message, response.icon);
                return;
            }

            // error jika akun perusahaan tidak terverifikasi
            if (jqXHR.status === 400) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.title, response.message, response.icon);

                return;
            }
        }
    })
}

function displayResumeFile() {
    const files = uploadResumeInput[0].files;
    uploadedFiles = Array.from(files);
    let existingFiles = resumeDisplayWrapper[0].children.length;

    if (existingFiles + uploadedFiles.length > 6) {
        return;
    }

    resumeDisplayWrapper.removeClass("d-none");
    resumeDisplayWrapper.addClass("d-block");
    uploadResumeBtn.hide();

    iterateFiles(uploadedFiles);
}

function iterateFiles(files) {
    let fileType = '';
    let fileIcon = '';
    let index = 0;

    resumeDisplayWrapper.empty();
    for (file of files) {
        fileType = file.type;
        fileIcon = FILE_ICON[fileType] ?? null;

        if (fileIcon === null) {
            continue;
        }

        resumeDisplayWrapper.append(`
            <div class="d-flex align-items-end gap-1">
                <i class="bi ${fileIcon}" style="font-size: 1.3rem;"></i>
                <div class="d-flex w-100">
                    <span style="font-size: .85rem;">${file.name}</span>
                    <button onclick="deleteResumeFile(${index++})" type="button" class="d-block ms-auto cursor-pointer border border-0 bg-transparent">
                        <i class="bi bi-trash" style="color: red;"></i>
                    </button>
                </div>
            </div>    
        `);
    }
}

function deleteResumeFile(index) {
    uploadedFiles.splice(index, 1);
    iterateFiles(uploadedFiles);

    if (uploadedFiles.length === 0) {
        uploadResumeBtn.show();
        resumeDisplayWrapper.removeClass("d-block");
        resumeDisplayWrapper.addClass("d-none");
    }
}

function applyVacancy() {
    const newForm = new FormData($("#student-apply-vacancy")[0]);

    for (let i = 0; i < uploadedFiles.length; i++) {
        newForm.append('resumes[]', uploadedFiles[i]);
    }

    $.ajax({
        url: '/apply',
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        data: newForm,
        processData: false,
        contentType: false,
        success: function (response) {
            let notification = response.notification;
            showCustomNotification(notification.title, notification.message, notification.icon);
            
            vacancyApplyFormContainer.removeClass("d-block");
            vacancyApplyFormContainer.addClass("d-none");
            vacancyApplyForm.html('');
        },
        error: function (jqXHR) {
            // error untuk kesalahaan server
            if (jqXHR.status === 500) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.title, response.message, response.icon);

                return;
            }

            // error kesalahan pada validasi token CSRF
            if (jqXHR.status === 419) {
                showCustomNotification("Request ditolak", "Request yang dikirim telah kadaluarsa", window.storage_path.path + 'svg/failed-x.svg');

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

                return;
            }

            // check apakah response code nya 403 (akses tidak diizinkan)
            if (jqXHR.status === 403) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.title, response.message, response.icon);

                return;
            }
        }
    })
}

function showCustomNotification(title, message, icon) {
    if (dashboardCustomNotification.hasClass("d-block")) {
        dashboardCustomNotification.removeClass("d-block");
        dashboardCustomNotification.addClass("d-none");

        return;
    }

    dashboardCustomNotification.removeClass("d-none");
    dashboardCustomNotification.addClass("d-block");

    $("#custom-notification-icon").attr('src', icon);
    $("#custom-notification-title").text(title);
    $("#custom-notification-message").text(message);
}