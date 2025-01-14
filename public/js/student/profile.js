const editProfileForm = $("#edit-profile-form");
const editProfileNotification = $("#edit-profile-notification");
const profileEditNotificationTitle = $("#profile-edit-notification-title");
const profileEditNotificationImg = $("#profile-edit-notification-img");
const deleteAccountNotification = $("#delete-account-notification");
const profileStudentCustomNotification = $("#custom-notification");

// function menampilkan notifikasi berhasil atau tidak update profile
function showEditProfileNotification() {
    if (editProfileNotification.hasClass("d-block")) {
        editProfileNotification.removeClass("d-block");
        editProfileNotification.addClass("d-none");

        return;
    }

    editProfileNotification.removeClass("d-none");
    editProfileNotification.addClass("d-block");
}

// function untuk mengirim data profile baru ke server
// function setProfileData() {
//     // the value of this variabel come from fetch result
//     profileEditNotificationTitle.text("Profil berhasil diperbarui!");
//     profileEditNotificationImg.attr("src", "http://localhost:8000/storage/svg/success-checkmark.svg");

//     showEditProfileNotification();
// }

// function untuk menampilkan notifikasi ingin menghapus akun RAIN
function showDeleteAccountCard() {
    if (deleteAccountNotification.hasClass("d-block")) {
        deleteAccountNotification.removeClass("d-block");
        deleteAccountNotification.addClass("d-none");

        return;
    }

    deleteAccountNotification.removeClass("d-none");
    deleteAccountNotification.addClass("d-block");
}

// function untuk mengirim request hapus akun RAIN ke server
function processDeleteAccountRequest() {
    $.ajax({
        url: "/api/dashboard/mahasiswa/profile/delete/account",
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        success: function (response) {
            let notification = response.notification;
            showCustomNotification(notification.title, notification.message, notification.icon);

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
    if (profileStudentCustomNotification.hasClass("d-block")) {
        profileStudentCustomNotification.removeClass("d-block");
        profileStudentCustomNotification.addClass("d-none");

        return;
    }

    profileStudentCustomNotification.removeClass("d-none");
    profileStudentCustomNotification.addClass("d-block");

    $("#custom-notification-icon").attr('src', icon);
    $("#custom-notification-title").text(title);
    $("#custom-notification-message").text(message);
}