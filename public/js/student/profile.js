const editProfileForm = document.querySelector("#edit-profile-form");
const editProfileBtn = document.querySelector("#edit-profile-btn");
const editProfileNotification = document.querySelector("#edit-profile-notification");
const profileEditNotificationTitle = document.querySelector("#profile-edit-notification-title");
const profileEditNotificationImg = document.querySelector("#profile-edit-notification-img");
const deleteAccountNotification = document.querySelector("#delete-account-notification");

// function menampilkan notifikasi berhasil atau tidak update profile
function showEditProfileNotification() {
    if (editProfileNotification.classList.contains("d-block")) {
        editProfileNotification.classList.remove("d-block");
        editProfileNotification.classList.add("d-none");

        return;
    }

    editProfileNotification.classList.remove("d-none");
    editProfileNotification.classList.add("d-block");
}

// function untuk mengirim data profile baru ke server
function setProfileData() {
    let form = new FormData(editProfileForm);
    console.log(form);

    // the value of this variabel come from fetch result
    profileEditNotificationTitle.textContent = "Profil berhasil diperbarui!";
    profileEditNotificationImg.src = "http://localhost:8000/storage/svg/success-checkmark.svg";

    showEditProfileNotification();
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