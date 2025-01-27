const editCompanyProfileForm = $("#edit-company-profile-form");
const editCompanyProfileNotification = $("#edit-company-profile-notification");
const deleteAccountCard = $("#delete-account-card");
const profileCompanyCustomNotification = $("#custom-notification");
const deleteAccountNotification = $("#delete-account-notification");

function editProfileCompanyData() {
    const form = new FormData(editCompanyProfileForm[0]);
    $.ajax({
        url: "/api/dashboard/perusahaan/profile/edit",
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        data: form,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success) {
                let notification = response.notification;
                showEditCompanyProfileNotification(notification.message, notification.icon);
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
    });
}

function showEditCompanyProfileNotification(message, image) {
    if (editCompanyProfileNotification.html().trim() !== "") {
        editCompanyProfileNotification.html("");
        return;
    }

    editCompanyProfileNotification.html(`
         <div class="position-absolute top-0 end-0 bottom-0 start-0 d-flex align-items-center justify-content-center"
                    style="background-color: rgba(0, 0, 0, .4)">
                    <div
                        class="profile__profile-edit-notification bg-white p-5 d-flex justify-content-center align-items-center position-relative">
                        <div>
                            <h5 id="profile-edit-notification-title" class="fw-700 text-center">${message}</h5>
                            <button onclick="showEditCompanyProfileNotification()"
                                class="profile__profile-edit-notification-btn border border-0 bni-blue fw-700 text-white d-block mx-auto mt-4">Tutup</button>
                        </div>
                        <img id="profile-edit-notification-img" src="${image}" alt=""
                            class="profile__profile-success-edit-icon position-absolute">
                    </div>
                </div>
    
    `);
}

// function untuk menampilkan notifikasi ingin menghapus akun RAIN
function showDeleteAccountCard() {
    if (deleteAccountCard.hasClass("d-block")) {
        deleteAccountCard.removeClass("d-block");
        deleteAccountCard.addClass("d-none");

        return;
    }

    deleteAccountCard.removeClass("d-none");
    deleteAccountCard.addClass("d-block");
}

// function untuk mengirim request hapus akun RAIN ke server
function processDeleteAccountRequest() {
    // kode isi request untuk menghapus akun
    $.ajax({
        url: "/api/dashboard/perusahaan/profile/delete/account",
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        success: function (response) {
            let notification = response.notification;
            showDeleteAccountNotification(notification.message);

            if (response.success) {
                setTimeout(() => {
                    window.location.replace('/index');
                }, 500);
            } else {
                setTimeout(() => {
                    deleteAccountNotification.removeClass("d-block");
                    deleteAccountNotification.addClass("d-none");
                }, 1000);
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
        }
    });
}

function showCustomNotification(title, message, icon) {
    if (profileCompanyCustomNotification.hasClass("d-block")) {
        profileCompanyCustomNotification.removeClass("d-block");
        profileCompanyCustomNotification.addClass("d-none");

        return;
    }

    profileCompanyCustomNotification.removeClass("d-none");
    profileCompanyCustomNotification.addClass("d-block");

    $("#custom-notification-icon").attr('src', icon);
    $("#custom-notification-title").text(title);
    $("#custom-notification-message").text(message);
}

function handleProfileFile() {
    const fileInput = $("#input-photo-profile")[0].files[0];
    if (!fileInput.type.startsWith('image/')) {
        return undefined;
    }

    const reader = new FileReader();
    reader.readAsDataURL(fileInput);

    reader.onload = event => {
        $("#user-profile")[0].src = event.target.result;
    }
}

function showDeleteAccountNotification(message) {
    if (deleteAccountNotification.hasClass("d-block")) {
        deleteAccountNotification.removeClass("d-block");
        deleteAccountNotification.addClass("d-none");

        return;
    }

    deleteAccountNotification.removeClass("d-none");
    deleteAccountNotification.addClass("d-block");

    $("#delete-account-notification-message").text(message);
}
