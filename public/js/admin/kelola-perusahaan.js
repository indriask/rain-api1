// load profile data when page is ready

const deleteUserBtn = $("#delete-user-btn");
const deleteUserVerify = $("#delete-user-verify");
const verifyCompanyAccount = $("#verify-company-account");

function showDeleteUser(id = 0) {
    if (deleteUserVerify.hasClass("d-block")) {
        deleteUserVerify.removeClass("d-block");
        deleteUserVerify.addClass("d-none");

        return
    }

    deleteUserVerify.removeClass("d-none");
    deleteUserVerify.addClass("d-block");
    $("#delete-user-action-btn").attr("onclick", `deleteUserAccount(${id})`);
}

function deleteUserAccount(id) {
    $.ajax({
        url: "/api/dashboard/admin/kelola/user/mahasiswa/delete",
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        data: JSON.stringify(id),
        success: function (response) {
            deleteUserVerify.removeClass("d-block");
            deleteUserVerify.addClass("d-none");

            $("#delete-user-notification").removeClass("d-none");
            $("#delete-user-notification").addClass("d-block");
            $("#delete-user-notification-message").text(response.message);

            setTimeout(() => {
                $("#delete-user-notification").removeClass("d-block");
                $("#delete-user-notification").addClass("d-none");
                $("#delete-user-notification-message").text("");
            }, 2500);
        },
        error: function (jqXHR) {
            if (jqXHR.status === 401) {
                let currentUrl = window.location.href;
                let currentPath = window.location.pathname;
                let url = currentUrl.split(currentPath);
                url[1] = 'index';

                url = url.join('/');
                window.location.replace(url);
                return false;
            }

            if (jqXHR.status === 403) {
                let currentUrl = window.location.href;
                let currentPath = window.location.pathname;
                let url = currentUrl.split(currentPath);
                url[1] = 'signin';

                url = url.join('/');
                window.location.replace(url);
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

function verifyCompany(id) {
    $.ajax({
        url: "/api/dashboard/admin/kelola/user/perusahaan/verify",
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        data: JSON.stringify(id),
        success: function (response) {
            verifyCompanyAccount.removeClass("d-block");
            verifyCompanyAccount.addClass("d-none");

            showVerifyNotificationCard(response.message, response.icon);
        },
        error: function (jqXHR) {
            if (jqXHR.status === 401) {
                let currentUrl = window.location.href;
                let currentPath = window.location.pathname;
                let url = currentUrl.split(currentPath);
                url[1] = 'index';

                url = url.join('/');
                window.location.replace(url);
                return false;
            }

            if (jqXHR.status === 403) {
                let currentUrl = window.location.href;
                let currentPath = window.location.pathname;
                let url = currentUrl.split(currentPath);
                url[1] = 'signin';

                url = url.join('/');
                window.location.replace(url);
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