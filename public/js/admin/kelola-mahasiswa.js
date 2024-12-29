const deleteUserBtn = $("#delete-user-btn");
const deleteUserVerify = $("#delete-user-verify");
const deleteUserNotification = $("#delete-user-notification");
const daftarPelamarCustomNotification = $("#custom-notification");

function showDeleteUser(id = 0) {
    if (deleteUserVerify.hasClass("d-block")) {
        deleteUserVerify.removeClass("d-block");
        deleteUserVerify.addClass("d-none");

        return;
    }

    deleteUserVerify.removeClass("d-none");
    deleteUserVerify.addClass("d-block");
    $("#delete-user-action-btn").attr("onclick", `deleteUserAccount(${id})`);
}

function deleteUserAccount(id) {
    $.ajax({
        url: "/api/dashboard/admin/kelola/user/delete",
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        data: { id_user: id },
        success: function (response) {
            let notification = response.notification;
            deleteUserVerify.removeClass("d-block");
            deleteUserVerify.addClass("d-none");

            showDeleteUserNotification(notification.message, notification.icon);
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
                return;
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
    })
}

function showDeleteUserNotification(message, icon) {
    if (deleteUserNotification.hasClass("d-block")) {
        deleteUserNotification.removeClass("d-block");
        deleteUserNotification.addClass("d-none");

        return
    }

    deleteUserNotification.removeClass("d-none");
    deleteUserNotification.addClass("d-block");

    $("#delete-user-notification-message").text(message);
    $("#delete-user-notification-icon").attr('src', icon);
}

function showCustomNotification(message, icon) {
    if (daftarPelamarCustomNotification.hasClass("d-block")) {
        daftarPelamarCustomNotification.removeClass("d-block");
        daftarPelamarCustomNotification.addClass("d-none");

        return;
    }

    daftarPelamarCustomNotification.removeClass("d-none");
    daftarPelamarCustomNotification.addClass("d-block");

    $("#custom-notification-message").text(message);
    $("#custom-notification-icon").attr('src', icon);
}