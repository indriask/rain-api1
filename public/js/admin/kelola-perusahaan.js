const deleteUserBtn = $("#delete-user-btn");
const deleteUserVerify = $("#delete-user-verify");
const verifyCompanyAccount = $("#verify-company-account");
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

function verifyCompany(id_user) {
    $.ajax({
        url: "/api/dashboard/admin/kelola/user/perusahaan/verify",
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        data: { id_user: id_user },
        success: function (response) {
            console.log(response);
            let notification = response.notification;
            verifyCompanyAccount.removeClass("d-block");
            verifyCompanyAccount.addClass("d-none");

            showVerifyNotificationCard(notification.message, notification.icon);
        },
        error: function (jqXHR) {
            console.log(jqXHR);

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
                showCustomNotification(notification.message, notification.icon);
                return;
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