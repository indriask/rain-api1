const deleteUserBtn = $("#delete-user-btn");
const deleteUserVerify = $("#delete-user-verify");
const verifyCompanyAccount = $("#verify-company-account");
const deleteUserNotification = $("#delete-user-notification");
const kelolaPerusahaanCustomNotification = $("#custom-notification");

// function untuk render halaman hapus user
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

// function untuk request hapus user
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

// function untuk render halaman verifikasi perusahaan
function showVerifyCompany(id) {
    if (verifyCompanyAccount.hasClass("d-block")) {
        verifyCompanyAccount.removeClass("d-block");
        verifyCompanyAccount.addClass("d-none");

        return
    }

    verifyCompanyAccount.removeClass("d-none");
    verifyCompanyAccount.addClass("d-block");
    $("#verify-company-action-btn").attr("onclick", `verifyCompany(${id})`);
}

// function untuk request verifikasi perusahaan
function verifyCompany(id_user) {
    $.ajax({
        url: "/api/dashboard/admin/kelola/user/perusahaan/verify",
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        data: { id_user: id_user },
        success: function (response) {
            let notification = response.notification;
            verifyCompanyAccount.removeClass("d-block");
            verifyCompanyAccount.addClass("d-none");

            showVerifyNotificationCard(notification.message, notification.icon);
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

// fucntion untuk render notifikasi berhasil atau gagal verifikasi
function showVerifyNotificationCard(message, icon) {
    const verifyNotificationCard = $("#verify-notification-card");
    if (verifyNotificationCard.hasClass("d-block")) {
        verifyNotificationCard.removeClass("d-block");
        verifyNotificationCard.addClass("d-none");

        return;
    }

    verifyNotificationCard.removeClass("d-none");
    verifyNotificationCard.addClass("d-block");

    $("#verify-notification-message").text(message);
    $("#verify-notification-message").get(0).src += icon;
}

// function untuk render notifikai berhasil atau gagal hapus user
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

// function untuk donwload lamaran mahasiswa
function installCooperationFile(id_user) {
    $.ajax({
        url: `/dashboard/admin/download/cooperation-file/${id_user}`,
        method: "GET",
        success: function (response) {
            if (response.success) {
                const link = document.createElement('a');
                link.href = response.url;
                link.setAttribute('download', '');
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

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
        }
    })
}

// function untuk view custom notificatio
function showCustomNotification(title, message, icon) {
    if (kelolaPerusahaanCustomNotification.hasClass("d-block")) {
        kelolaPerusahaanCustomNotification.removeClass("d-block");
        kelolaPerusahaanCustomNotification.addClass("d-none");

        return;
    }

    kelolaPerusahaanCustomNotification.removeClass("d-none");
    kelolaPerusahaanCustomNotification.addClass("d-block");

    $("#custom-notification-icon").attr('src', icon);
    $("#custom-notification-title").text(title);
    $("#custom-notification-message").text(message);
}