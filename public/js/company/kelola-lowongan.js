const manageVacancyDetail = $("#manage-vacancy-detail");
let manageVacancyForm = null;
let manageVacancyNotification = null;
const daftarPelamarCustomNotification = $("#custom-notification");

// function untuk menampilkan detail lowongan yang di publish
function showDetailManageVacancy(id = 0) {
    if (manageVacancyDetail.text().trim() !== '') {
        manageVacancyDetail.text("");
        manageVacancyDetail.addClass("d-none");

        $("#dashboard__not-found-container").remove();

        return;
    }

    manageVacancyDetail.removeClass("d-none");

    $.ajax({
        url: `/dashboard/perusahaan/kelola/lowongan/${id}`,
        method: "GET",
        headers: { "X-GET-DATA": "specific-data-company" },
        success: function (response) {
            if (response.vacancy === null || response.vacancy === undefined) {
                manageVacancyDetail.html(`
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
                            class="bni-blue border border-0 text-white click-animation rounded d-block mx-auto p-1 click-animation cursor-pointer"
                            style="width: 90px;" onclick="showDetailManageVacancy()">Tutup</button>
                    </div>
                </div>
                `);
                return false;
            }

            manageVacancyDetail.html(`
                 <form id="manage-vacancy-form" method="POST" enctype="multipart/form-data"
                     class="dashboard__manage-vacancy-form bg-white p-4 d-flex align-items-center justify-content-center gap-4 mt-3 position-relative">
                     <div id="manage-vacancy-input" class="w-50 d-block">
                         <div class="dashboard__manage-vacancy-input">
                             <label for="gaji">Gaji</label>
                             <div>
                                 <div>
                                    <input type="text" style="width: 120px" class="focus-ring" name="salary"
                                        value="${response.vacancy.salary}">
                                    <span class="mx-2">/</span>
                                    <span>Bulan</span>
                                 </div>
                                 <div id="input-salary"></div>
                             </div>

                             <label for="judul" class="fw-600">Judul</label>
                             <div>
                                <input type="text" name="title" class="focus-ring" value="${response.vacancy.title}">
                                <div id="input-title"></div>
                             </div>

                             <label for="jurusan" class="fw-600">Jurusan</label>
                            <div>
                                 <select id='manage-vacancy-major-list' name="id_major" id="jurusan"
                                    class="bg-white border border-0 cursor-pointer focus-ring">
                                    <option value="3">Teknik Informatika</option>
                                    <option value="2">Teknik Elekro</option>
                                    <option value="4">Teknik Mesin</option>
                                    <option value="1">Manajemen Bisnis</option>
                                 </select>
                                 <div id="input-major"></div>
                            </div>

                             <label for="lokasi" class="fw-600">Lokasi</label>
                             <div>
                                <input type="text" name="location" class="focus-ring" value="${response.vacancy.location}">
                                <div id="input-location"></div>
                             </div>

                             <label for="dibuka" class="fw-600">Dibuka</label>
                             <div>
                                 <div>
                                    <input type="date" style="width: 120px" value="${response.vacancy.date_created}" class="focus-ring" name="date_created">
                                 <span class="mx-2">-</span>
                                 <input type="date" style="width: 120px;" value="${response.vacancy.date_ended}" class="focus-ring" name="date_ended">
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
                                     <input type="radio" name="time_type" value="part time"
                                         id="part-time">
                                     <label for="part-time">Part time</label>
                                 </div>
                                 <div id="input-time-type"></div>
                                 </div>
                             </div>

                             <label for="jenis" class="fw-600">Jenis</label>
                             <div>
                                <select name="type" id="manage-vacancy-type-list"
                                 class="focus-ring bg-white border border-0 cursor-pointer">
                                 <option value="online">Online</option>
                                 <option value="offline">Offline</option>
                             </select>
                             <div id="input-type"></div>
                             </div>

                             <label for="durasi" class="fw-600">Durasi</label>
                             <div>
                                <div>
                                     <input type="text" name="duration" style='width: 100px;' class="focus-ring me-2" value="${response.vacancy.duration}">
                                 <span>/ Bulan</span>
                                </div>
                                <div id="input-duration"></div>
                             </div>

                             <label for="pendaftar" class="fw-600">Quota</label>
                             <div>
                                 <div>
                                    <input type="text" name="quota" id="" value="${response.vacancy.quota}"
                                     class="focus-ring me-2" style="width: 100px;">
                                 <span>/ Pelamar</span>
                                 </div>
                                 <div id="input-quota"></div>
                             </div>
                         </div>
                     </div>
                     <div id="manage-vacancy-detail" class="w-50 d-block">
                         <label for="detail-lowongan" class="fw-600 d-block">Detail lowongan</label>
                         <textarea name="description" id="" class="dashboard__manage-vacancy-textarea border border-0 p-3">${response.vacancy.description}</textarea>
                     </div>
                     <div class="position-absolute bottom-0 start-0 end-0 py-3 px-4 d-flex justify-content-between">
                         <button id="manage-vacancy-back-form" class="border click-animation border-0 bni-blue text-white fw-700"
                             onclick="showDetailManageVacancy()" type="button">Tutup</button>
                         <div class="d-flex gap-2">
                             <button id="manage-vacancy-submit" class="border border-0 click-animation bni-blue text-white fw-700"
                                 onclick="deleteManageVacancy(${response.vacancy.id_vacancy}, '${response.vacancy.company.nib}')" type="button">Hapus</button>
                             <button id="manage-vacancy-submit" class="border click-animation border-0 bni-blue text-white fw-700"
                                 onclick="editManageVacancy()" type="button">Edit</button>
                         </div>
                     </div>
                     <input type="hidden" name="id_vacancy" value="${response.vacancy.id_vacancy}">
                     <input type="hidden" name="nib" value="${response.vacancy.company.nib}">
                 </form>

                 <div id="manage-vacancy-notification"
                     class="d-none dashboard__manage-vacancy-notification position-absolute bg-white p-4 mt-3 d-flex flex-column align-items-center justify-content-center">
                     <h5 id="manage-vacancy-notification-title" class="fw-700">Perubahan berhasil di simpan!</h5>
                     <img src="" alt="" id="manage-vacancy-notification-icon" class="fw-700">
                     <button class="border border-0 bni-blue text-white click-animation fw-700 position-relative"
                         onclick="showManageVacancyCardNotification()">Tutup</button>
                 </div>
            `);

            const majorList = $("#manage-vacancy-major-list").children();
            majorList.each((index, element) => {
                if (response.vacancy.major.id == element.value) {
                    element.selected = true;
                    return;
                }
            });

            const timeTypeList = $('input[name="time_type"]');
            timeTypeList.each((index, element) => {
                if (response.vacancy.time_type === element.value) {
                    element.checked = true;
                    return;
                }
            });

            const typeList = $("#manage-vacancy-type-list").children();
            typeList.each((index, element) => {
                if (response.vacancy.type === element.value) {
                    element.selected = true;
                    return;
                }
            });

            manageVacancyForm = $("#manage-vacancy-form");
            manageVacancyNotification = $("#manage-vacancy-notification");
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

// function untuk edit data lowongan ke server
function editManageVacancy(id = 0) {
    const form = new FormData(manageVacancyForm.get(0));

    $.ajax({
        url: "/api/dashboard/perusahaan/kelola/lowongan/edit",
        method: "POST",
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
            showManageVacancyCardNotification(notification.message, notification.icon);
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
                return;
            }

            // error jika akun perusahaan tidak terverifikasi
            if (jqXHR.status === 400) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.message, response.icon);
                return false;
            }
        }
    });
}

// function untuk menampilkan notifikasi brhasil atau tidak edit lowongan
function showManageVacancyCardNotification(message, icon) {
    if (manageVacancyNotification.hasClass("d-block")) {
        manageVacancyNotification.removeClass("d-block");
        manageVacancyNotification.addClass("d-none");

        manageVacancyForm.trigger('reset');

        manageVacancyDetail.text("");
        manageVacancyDetail.addClass("d-none");

        return;
    }

    const notificationTitle = $("#manage-vacancy-notification-title");
    const notificationIcon = $("#manage-vacancy-notification-icon");

    notificationTitle.text(message);
    notificationIcon.attr('src', icon);

    manageVacancyNotification.removeClass("d-none");
    manageVacancyNotification.addClass("d-block");

    return;
}

// function untuk hapus data lowongan di database
function deleteManageVacancy(id = 0, nib = "") {
    $.ajax({
        url: "/api/dashboard/perusahaan/kelola/lowongan/delete",
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        data: { 'id_vacancy': id, 'nib': nib },
        dataType: 'json',
        success: function (response) {
            let notification = response.notification;
            showManageVacancyCardNotification(notification.message, notification.icon);
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
                return;
            }

            // error jika akun perusahaan tidak terverifikasi
            if (jqXHR.status === 400) {
                let response = jqXHR.responseJSON.notification;
                showCustomNotification(response.message, response.icon);
                return false;
            }
        }
    });
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