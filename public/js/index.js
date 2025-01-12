const indexCustomNotification = $("#custom-notification");
const contactUsForm = $("#contact-us-form");

function sendFeedback() {
    const contactUsFormObject = new FormData(contactUsForm[0]);
    
    $.ajax({
        url: "/api/send-feedback",
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        data: contactUsFormObject,
        processData: false,
        contentType: false,
        success: function (response) {
            if(response.success) {
                let notification = response.notification;
                
                showCustomNotification(notification.title, notification.message, notification.icon);
            } else {
                let notification = response.notification;
                let error = JSON.parse(notification.message);

                showCustomNotification(notification.title, error?.email ?? error?.feedback, notification.icon);
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

function showCustomNotification(title, message, icon) {
    if (indexCustomNotification.hasClass("d-block")) {
        indexCustomNotification.removeClass("d-block");
        indexCustomNotification.addClass("d-none");

        return;
    }

    indexCustomNotification.removeClass("d-none");
    indexCustomNotification.addClass("d-block");

    $("#custom-notification-icon").attr('src', icon);
    $("#custom-notification-title").text(title);
    $("#custom-notification-message").text(message);
}