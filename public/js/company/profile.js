const editCompanyProfileForm = document.querySelector("#edit-company-profile-form");
const editCompanyProfileNotification = document.querySelector("#edit-company-profile-notification");
const deleteAccountNotification = document.querySelector("#delete-account-notification");

function editProfileCompanyData(id) {
    let form = new FormData(editCompanyProfileForm);
    showEditCompanyProfileNotification("Profile berhasil diperbaharui!", "http://localhost:8000/storage/svg/success-checkmark.svg");
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