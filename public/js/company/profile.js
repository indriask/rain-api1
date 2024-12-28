const editCompanyProfileForm = $("#edit-company-profile-form");
const editCompanyProfileNotification = document.querySelector("#edit-company-profile-notification");
const deleteAccountNotification = document.querySelector("#delete-account-notification");
const daftarPelamarCustomNotification = $("#custom-notification");

function editProfileCompanyData() {
    const form = new FormData(editCompanyProfileForm[0]);
    console.log(form);
    $.ajax({
        url: "/api/dashboard/perusahaan/profile/edit",
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        data: form,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);

            let notification = response.notification;
            showEditCompanyProfileNotification(notification.message, notification.icon);
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
        }
    });
}

function showEditCompanyProfileNotification(message, image) {
    if (editCompanyProfileNotification.textContent.trim() !== "") {
        editCompanyProfileNotification.textContent = "";
        return;
    }

    editCompanyProfileNotification.innerHTML = `
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
    
    `;
}

// function untuk menampilkan notifikasi ingin menghapus akun RAIN
function showDeleteAccountCard() {
    if (deleteAccountNotification.classList.contains("d-block")) {
        deleteAccountNotification.classList.remove("d-block");
        deleteAccountNotification.classList.add("d-none");

        return;
    }

    deleteAccountNotification.classList.remove("d-none");
    deleteAccountNotification.classList.add("d-block");
}

// function untuk mengirim request hapus akun RAIN ke server
function processDeleteAccountRequest() {
    // kode isi request untuk menghapus akun
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