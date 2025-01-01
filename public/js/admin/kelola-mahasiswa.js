const deleteUserBtn = $("#delete-user-btn");
const deleteUserVerify = $("#delete-user-verify");
const deleteUserNotification = $("#delete-user-notification");
const kelolaMahasiswaCustomNotification = $("#custom-notification");

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

function showCustomNotification(title, message, icon) {
    if (kelolaMahasiswaCustomNotification.hasClass("d-block")) {
        kelolaMahasiswaCustomNotification.removeClass("d-block");
        kelolaMahasiswaCustomNotification.addClass("d-none");

        return;
    }

    kelolaMahasiswaCustomNotification.removeClass("d-none");
    kelolaMahasiswaCustomNotification.addClass("d-block");

    $("#custom-notification-icon").attr('src', icon);
    $("#custom-notification-title").text(title);
    $("#custom-notification-message").text(message);
}