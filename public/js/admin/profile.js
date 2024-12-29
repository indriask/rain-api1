const editAdminProfileForm = $("#edit-admin-profile-form");
const editAdminProfileNotification = $("#edit-admin-profile-notification");
const deleteAccountNotification = document.querySelector("#delete-account-notification");

function editProfileAdminData() {
    let form = new FormData(editAdminProfileForm[0]);
    $.ajax({
        url: '/api/dashboard/admin/profile/edit',
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        data: form,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.success) {
                let notification = response.notification;
                showEditAdminProfileNotification(notification.message, notification.icon);
            }
        },
        error: function (jqXHR) {
            console.log(jqXHR);
        }
    })
}

function showEditAdminProfileNotification(message, icon) {
    if (editAdminProfileNotification.text().trim() !== "") {
        editAdminProfileNotification.text("");
        return;
    }

    editAdminProfileNotification.html(`
         <div class="position-absolute top-0 end-0 bottom-0 start-0 d-flex align-items-center justify-content-center"
                    style="background-color: rgba(0, 0, 0, .4)">
                    <div
                        class="profile__profile-edit-notification bg-white p-5 d-flex justify-content-center align-items-center position-relative">
                        <div>
                            <h5 id="profile-edit-notification-title" class="fw-700 text-center">${message}</h5>
                            <button onclick="showEditAdminProfileNotification()"
                                class="profile__profile-edit-notification-btn border click-animation border-0 bni-blue fw-700 text-white d-block mx-auto mt-4">Tutup</button>
                        </div>
                        <img id="profile-edit-notification-img" src="${icon}" alt=""
                            class="profile__profile-success-edit-icon position-absolute">
                    </div>
                </div>
    
    `);
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
