const deleteUserBtn = $("#delete-user-btn");
const deleteUserVerify = $("#delete-user-verify");

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