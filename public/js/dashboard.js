/**
 * variable for dashboard home page
 */
const vacancyCardListContainer = document.querySelector("#vacancy-card-list-container");
const vacancyDetailCard = document.querySelector("#vacancy-detail-card");
const vacancyApplyFormContainer = document.querySelector("#vacancy-apply-form-container")
const applyFormNotifcation = document.querySelector("#apply-form-notification");
const vacancyApplyForm = document.querySelector("#vacancy-apply-form");

/**
 * variable for student dashboard vacancy list
 */
const studentAppliedVacancyStatus = document.querySelector("#applied-vacancy-status");
const studentAppliedVacancyStatusInfo = document.querySelector("#apply-status-info");

/**
 * Variable for student profile
 */
const editProfileForm = document.querySelector("#edit-profile-form");
const editProfileBtn = document.querySelector("#edit-profile-btn");

const editProfileNotification = document.querySelector("#edit-profile-notification");
const profileEditNotificationTitle = document.querySelector("#profile-edit-notification-title");
const profileEditNotificationImg = document.querySelector("#profile-edit-notification-img");

const deleteAccountNotification = document.querySelector("#delete-account-notification");
const logoutNotification = document.querySelector("#logout-notification");

/**
 * Variable for company add vacancy
 */
const addVacancy = document.querySelector("#add-vacancy");
const addVacancyInput = document.querySelector("#add-vacancy-input");
const addVacancyDetail = document.querySelector("#add-vacancy-detail");
const addVacancyLogo = document.querySelector("#add-vacancy-logo");
const addVacancySubmitBtn = document.querySelector("#add-vacancy-submit");
const addVacancyNextForm = document.querySelector("#add-vacancy-next-form");
const addVacancyForm = document.querySelector("#add-vacancy-form");
const addVacancyNotification = document.querySelector("#add-vacancy-notification");

/**
 * Variabel for manage vacancy 
 */
const manageVacancyContainer = document.querySelector("#manage-vacancy-container");
const manageVacancyForm = document.querySelector("#manage-vacancy-form");
const manageVacancyInput = document.querySelector("#manage-vacancy-input");
const manageVacancyDetail = document.querySelector("#manage-vacancy-detail");
const manageVacancyLogo = document.querySelector("#manage-vacancy-logo");
const manageVacancyBackForm = document.querySelector("#manage-vacancy-back-form");
const manageVacancyNextForm = document.querySelector("#manage-vacancy-next-form");
const manageVacancySubmitBtn = document.querySelector("#manage-vacancy-submit");
const manageVacancyNotification = document.querySelector("#manage-vacancy-notification");

/**
 * Variable for proposal card list
 */
const daftarPelamarStudentProfile = document.querySelector("#daftar-pelamar-student-profile");
const daftarPelamarProposalInfoContainer = document.querySelector("#daftar-pelamar-proposal-info-container");
const daftarPelamarUpdateProposalStatus = document.querySelector("#daftar-pelamar-update-proposal-status")
const daftarPelamarUpdateOptionProposalStatus = document.querySelector("#daftar-pelamar-update-option-proposal-status");
const daftarPelamarUpdateProposalStatusNotification = document.querySelector("#daftar-pelamar-update-proposal-status-notification");
const daftarPelamarHapusPelamar = document.querySelector("#daftar-pelamar-hapus-pelamar");

/**
 * variabel for profile ccompnay
 */
const editCompanyProfileForm = document.querySelector("#edit-company-profile-form");
const editCompanyProfileNotification = document.querySelector("#edit-company-profile-notification");

/**
 * function for dashboard home page
 */
function showVacancyDetail(id = 0) {
    vacancyDetailCard.classList.remove("d-none", "pe-none");
    vacancyDetailCard.classList.add("d-block");

    return 1;
}

function closeVacancyDetail() {
    vacancyDetailCard.classList.remove("d-block");
    vacancyDetailCard.classList.add("d-none", "pe-none");

    return 1;
}

function showApplyVacancyFormContainer(id) {
    vacancyApplyFormContainer.classList.remove("d-none", "pe-none");
    vacancyApplyFormContainer.classList.add("d-block");

    return 1;
}

function closeApplyVacancyFormContainer() {
    vacancyApplyFormContainer.classList.remove("d-block");
    vacancyApplyFormContainer.classList.add("d-none", "pe-none");

    return 1;
}

function processAddProposal(id) {
    showNotification();
}

function showNotification() {
    applyFormNotifcation.classList.remove("d-none", "pe-none");
    applyFormNotifcation.classList.add("d-block");

    vacancyApplyForm.classList.add("d-none", "pe-none");

    return 1;
}

function closeAllFormCard() {
    applyFormNotifcation.classList.remove("d-block");
    applyFormNotifcation.classList.add("d-none", "pe-none");

    vacancyApplyForm.classList.remove("d-none", "pe-none");

    closeApplyVacancyFormContainer();
    closeVacancyDetail();

    return 1;
}

/**
 * function for student dashboard vacancy list
 */
function showStudentVacancyStatus(id) {
    let template = ''

    if (studentAppliedVacancyStatus.textContent.trim() === "") {
        template = `
                <div
                    class="applied-vacancy-status position-absolute top-0 start-0 end-0 bottom-0 d-flex align-items-center justify-content-center">
                    <div class="status-btn-container bg-white p-5">
                        <div class="d-flex justify-content-between mk">
                            <button onclick="getApplyStatusInfo(${id})"
                                class="border border-0 text-white fw-500 bni-blue">LAMARAN</button>
                            <button onclick="getInterviewStatusInfo(${id})"
                                class="border border-0 text-white fw-500 bni-blue">WAWANCARA</button>
                        </div>
                        <button class="border border-0 text-white fw-500 bni-blue d-block mx-auto mt-4 rounded"
                            style="width: 100px; font-size: .9rem; padding: 5px;"
                            onclick="showStudentVacancyStatus()">Kembali</button>
                    </div>
                </div>
    `;
    }

    studentAppliedVacancyStatus.innerHTML = template;
    return 1;
}

function getApplyStatusInfo(id) {
    fetch("/api/dashboard/mahasiswa/list/lamaran/status/lamaran", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": window.laravel.csrf_token,
            "Content-Type": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            studentAppliedVacancyStatusInfo.innerHTML = `
         <div class="position-absolute top-0 start-0 bottom-0 end-0 d-flex align-items-center justify-content-center"
                         style="background-color: rgba(0, 0, 0, .4)">
                         <div class="bg-white rounded d-flex align-items-center justify-content-center flex-column p-5"
                             style="width: 500px; border-radius: 15px;">
                             <h5 class="fw-700">${data['data']['title']}</h5>
                             <span class="text-center" style="font-size: .8rem">Silahkan menunggu konfirmasi
                                 selanjutnya yaa!</span>

                             <button class="border border-0 text-white bni-blue fw-700 rounded mt-4"
                                 style="width: 100px; padding: 5px; font-size: .9rem" onclick="closeStatusInfo()">Kembali</button>
                         </div>
                     </div>
     `;
        });
}

function getInterviewStatusInfo(id) {
    fetch(`/api/dashboard/mahasiswa/list/lamaran/status/wawancara/`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": window.laravel.csrf_token,
            "Content-Type": "application/json"
        },
    })
        .then(response => response.json())
        .then(data => {
            studentAppliedVacancyStatusInfo.innerHTML = `
                            <div class="position-absolute top-0 start-0 bottom-0 end-0 d-flex align-items-center justify-content-center"
                        style="background-color: rgba(0, 0, 0, .4)">
                        <div class="bg-white d-flex rounded align-items-center justify-content-center flex-column p-5"
                            style="width: 600px border-radius: 15px;">
                            <h5 class="fw-700 text-center">Wawancara mu sedang dipertimbangkan!</h5>
                            <span class="text-center" style="font-size: .8rem">Silahkan menunggu konfirmasi
                                selanjutnya yaa!</span>

                            <button class="border border-0 text-white bni-blue fw-700 rounded mt-4"
                                style="width: 100px; padding: 5px; font-size: .9rem" onclick="closeStatusInfo()">Kembali</button>
                        </div>
                    </div>
    `;
        });
}

function closeStatusInfo() {
    studentAppliedVacancyStatusInfo.innerHTML = '';
}

/**
 * Function for student profile
 */

function showEditProfileNotification() {
    if (editProfileNotification.classList.contains("d-block")) {
        editProfileNotification.classList.remove("d-block");
        editProfileNotification.classList.add("d-none");

        return;
    }

    editProfileNotification.classList.remove("d-none");
    editProfileNotification.classList.add("d-block");
}

function setProfileData() {
    let form = new FormData(editProfileForm);
    console.log(form);

    // the value of this variabel come from fetch result
    profileEditNotificationTitle.textContent = "Profil berhasil diperbarui!";
    profileEditNotificationImg.src = "http://localhost:8000/storage/svg/success-checkmark.svg";

    showEditProfileNotification();
}

function showDeleteAccountCard() {
    if (deleteAccountNotification.classList.contains("d-block")) {
        deleteAccountNotification.classList.remove("d-block");
        deleteAccountNotification.classList.add("d-none");

        return;
    }

    deleteAccountNotification.classList.remove("d-none");
    deleteAccountNotification.classList.add("d-block");
}

function processDeleteAccountRequest() {
    // kode isi request untuk menghapus akun
}

function showLogoutCard() {
    if (logoutNotification.classList.contains("d-block")) {
        logoutNotification.classList.remove("d-block");
        logoutNotification.classList.add("d-none");

        return;
    }

    logoutNotification.classList.remove("d-none");
    logoutNotification.classList.add("d-block");
}

// do logout logic
function processLogoutRequest() {

}

/**
 * Function for company add vacancy
 */
function showAddVacancyCard() {
    if (addVacancy.classList.contains("d-block")) {
        addVacancy.classList.remove("d-block");
        addVacancy.classList.add("d-none");

        return;
    }

    addVacancy.classList.remove("d-none");
    addVacancy.classList.add("d-block");
}

function showAddVacancyInput() {
    if (addVacancyInput.classList.contains("d-block")) {
        addVacancyInput.classList.remove("d-block");
        addVacancyInput.classList.add("d-none");

        return;
    }

    addVacancyInput.classList.remove("d-none");
    addVacancyInput.classList.add("d-block");
}

function showAddVacancyDetail() {
    if (addVacancyDetail.classList.contains("d-block")) {
        addVacancyDetail.classList.remove("d-block");
        addVacancyDetail.classList.add("d-none");

        return;
    }

    addVacancyDetail.classList.remove("d-none");
    addVacancyDetail.classList.add("d-block");
}

function backAddVacancyForm() {
    if (addVacancyInput.classList.contains("d-none") && addVacancyDetail.classList.contains("d-none")) {
        addVacancyLogo.classList.remove("d-block");
        addVacancyLogo.classList.add("d-none");

        addVacancyInput.classList.remove("d-none");
        addVacancyInput.classList.add("d-block");

        addVacancyDetail.classList.remove("d-none");
        addVacancyDetail.classList.add("d-block");

        addVacancyNextForm.classList.remove("d-none");
        addVacancyNextForm.classList.add("d-block");

        addVacancySubmitBtn.classList.remove("d-block");
        addVacancySubmitBtn.classList.add("d-none");

        return;
    }
}

function nextVacancyForm() {
    if (addVacancyInput.classList.contains("d-block") && addVacancyDetail.classList.contains("d-block")) {
        addVacancyLogo.classList.remove("d-none");
        addVacancyLogo.classList.add("d-block");

        addVacancyInput.classList.remove("d-block");
        addVacancyInput.classList.add("d-none");

        addVacancyDetail.classList.remove("d-block");
        addVacancyDetail.classList.add("d-none");

        addVacancyNextForm.classList.remove("d-block");
        addVacancyNextForm.classList.add("d-none");

        addVacancySubmitBtn.classList.remove("d-none");
        addVacancySubmitBtn.classList.add("d-block");

        return;
    }
}

function processAddVacancy() {
    const form = new FormData(addVacancyForm);
    console.log(form);
}

function showAddVacancyNotification(message, icon) {
    const notificationTitle = document.querySelector("#add-vacancy-notification-title");
    const notificationIcon = document.querySelector("#add-vacancy-notification-icon");

    notificationTitle.textContent = message;
    notificationIcon.src = icon;

    addVacancyNotification.classList.remove("d-none");
    addVacancyNotification.classList.add("d-block");
}

function closeAddVacancyForm() {
    addVacancyNotification.classList.remove("d-block");
    addVacancyNotification.classList.add("d-none");

    addVacancyLogo.classList.remove("d-block");
    addVacancyLogo.classList.add("d-none");

    addVacancyDetail.classList.remove("d-none");
    addVacancyDetail.classList.add("d-block");

    addVacancyInput.classList.remove("d-none");
    addVacancyInput.classList.add("d-block");

    addVacancySubmitBtn.classList.remove("d-block");
    addVacancySubmitBtn.classList.add("d-none");

    addVacancyNextForm.classList.remove("d-none");
    addVacancyNextForm.classList.add("d-block");

    addVacancy.classList.remove("d-block");
    addVacancy.classList.add("d-none");

    addVacancyForm.reset();

    return;
}

/**
 * function for manage vacancy
 */
function showManageVacancyCard(id = 0) {
    if (manageVacancyContainer.classList.contains("d-block")) {
        manageVacancyContainer.classList.remove("d-block");
        manageVacancyContainer.classList.add("d-none");

        return;
    }

    manageVacancyContainer.classList.remove("d-none");
    manageVacancyContainer.classList.add("d-block");

    return 1;
}

function nextManageVacancyForm() {
    if (manageVacancyInput.classList.contains("d-block") && manageVacancyDetail.classList.contains("d-block")) {
        manageVacancyLogo.classList.remove("d-none");
        manageVacancyLogo.classList.add("d-block");

        manageVacancyInput.classList.remove("d-block");
        manageVacancyInput.classList.add("d-none");

        manageVacancyDetail.classList.remove("d-block");
        manageVacancyDetail.classList.add("d-none");

        manageVacancyNextForm.classList.remove("d-block");
        manageVacancyNextForm.classList.add("d-none");

        manageVacancySubmitBtn.classList.remove("d-none");
        manageVacancySubmitBtn.classList.add("d-block");

        return;
    }
}

function backManageVacancyForm() {

    if (manageVacancyLogo.classList.contains("d-none")) {
        manageVacancyContainer.classList.remove("d-block");
        manageVacancyContainer.classList.add("d-none");

        return;
    }

    if (manageVacancyLogo.classList.contains("d-block")) {
        manageVacancyLogo.classList.remove("d-block");
        manageVacancyLogo.classList.add("d-none");

        manageVacancyInput.classList.remove("d-none");
        manageVacancyInput.classList.add("d-block");

        manageVacancyDetail.classList.remove("d-none");
        manageVacancyDetail.classList.add("d-block");

        manageVacancyNextForm.classList.remove("d-none");
        manageVacancyNextForm.classList.remove("d-block");

        manageVacancySubmitBtn.classList.remove("d-block");
        manageVacancySubmitBtn.classList.add("d-none");

        return;
    }
}

function closeManageVacancyForm() {
    manageVacancyNotification.classList.remove("d-block");
    manageVacancyNotification.classList.add("d-none");

    manageVacancyLogo.classList.remove("d-block");
    manageVacancyLogo.classList.add("d-none");

    manageVacancyDetail.classList.remove("d-none");
    manageVacancyDetail.classList.add("d-block");

    manageVacancyInput.classList.remove("d-none");
    manageVacancyInput.classList.add("d-block");

    manageVacancySubmitBtn.classList.remove("d-block");
    manageVacancySubmitBtn.classList.add("d-none");

    manageVacancyNextForm.classList.remove("d-none");
    manageVacancyNextForm.classList.add("d-block");

    manageVacancyContainer.classList.remove("d-block");
    manageVacancyContainer.classList.add("d-none");

    manageVacancyForm.reset();

    return;
}

function showManageVacancyCardNotification(message, icon) {
    const notificationTitle = document.querySelector("#manage-vacancy-notification-title");
    const notificationIcon = document.querySelector("#manage-vacancy-notification-icon");

    notificationTitle.textContent = message;
    notificationIcon.src = icon;

    manageVacancyNotification.classList.remove("d-none");
    manageVacancyNotification.classList.add("d-block");

    return;
}

function editManageVacancy(id = 0) {
    // edit vacancy card
    showManageVacancyCardNotification("Perubahan berhasil di edit!", "http://localhost:8000/storage/svg/success-checkmark.svg");
}

/**
 * Function for proposal card list
 */
function showStudentProfile() {
    if (daftarPelamarStudentProfile.classList.contains("d-block")) {
        daftarPelamarStudentProfile.classList.remove("d-block");
        daftarPelamarStudentProfile.classList.add("d-none");

        return;
    }

    daftarPelamarStudentProfile.classList.remove("d-none");
    daftarPelamarStudentProfile.classList.add("d-block");
}

function showStudentProposal(id) {
    if (daftarPelamarProposalInfoContainer.classList.contains("d-block")) {
        daftarPelamarProposalInfoContainer.classList.remove("d-block");
        daftarPelamarProposalInfoContainer.classList.add("d-none");

        return;
    }

    daftarPelamarProposalInfoContainer.classList.remove("d-none");
    daftarPelamarProposalInfoContainer.classList.add("d-block");

    // fetch data to backend
}

function installProposalFiles(id) {
    // do installation on student proposal files
}

function showUpdateStatusProposal(id) {
    if (daftarPelamarUpdateProposalStatus.textContent.trim() !== '') {
        daftarPelamarUpdateProposalStatus.textContent = '';

        return;
    }

    daftarPelamarUpdateProposalStatus.innerHTML = `
                <div
                    class="applied-vacancy-status position-absolute top-0 start-0 end-0 bottom-0 d-flex align-items-center justify-content-center">
                    <div class="status-btn-container bg-white p-5">
                        <div class="d-flex justify-content-between mk">
                            <button onclick="showUpdateOptionStatusProposal(${id}, 'lamaran')"
                                class="border border-0 text-white fw-500 bni-blue">LAMARAN</button>
                            <button onclick="showUpdateOptionStatusProposal(${id}, 'wawancara')"
                                class="border border-0 text-white fw-500 bni-blue">WAWANCARA</button>
                        </div>
                        <button class="border border-0 text-white fw-500 bni-blue d-block mx-auto mt-4 rounded"
                            style="width: 100px; font-size: .9rem; padding: 5px;"
                            onclick="showUpdateStatusProposal(${id})">Tutup</button>
                    </div>
                </div>
    `;
}

function showUpdateOptionStatusProposal(id, type) {
    if (daftarPelamarUpdateOptionProposalStatus.textContent.trim() !== "") {
        daftarPelamarUpdateOptionProposalStatus.textContent = "";

        return;
    }

    daftarPelamarUpdateOptionProposalStatus.innerHTML = `
            <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex align-items-center justify-content-center"
                    style="background-color: rgba(0, 0, 0, .4)">
                    <div class="status-btn-container bg-white p-5" style="width: 500px;">
                        <div class="d-flex justify-content-between mk d-flex gap-3">
                            <button onclick="updateStatusProposal('review', ${id}, '${type}')"
                                class="border border-0 bg-primary text-white fw-500">TINJAU</button>
                            <button onclick="updateStatusProposal('approved', ${id}, '${type}')"
                                class="border border-0 text-white bg-success fw-500">TERIMA</button>
                            <button onclick="updateStatusProposal('rejected', ${id}, '${type}')" class="border border-0 text-white bg-danger fw-500">TOLAK</button>
                        </div>
                        <button class="border border-0 text-white fw-500 bni-blue d-block mx-auto mt-4 rounded"
                            style="width: 100px; font-size: .9rem; padding: 5px;"
                            onclick="showUpdateOptionStatusProposal()">Tutup</button>
                    </div>
                </div>
    `;
}

function updateStatusProposal(status, id, type) {
    console.log(status, id, type);
    updateProposalStatusNotification('Status berhasil diperbarui!', 'Terjadi kesalahan saat melakukan update data, silahkan coba lagi!', 'http://localhost:8000/storage/svg/success-checkmark.svg');
}

function updateProposalStatusNotification(title, message, image) {
    if (daftarPelamarUpdateProposalStatusNotification.textContent.trim() !== "") {
        daftarPelamarUpdateProposalStatusNotification.textContent = "";
        return;
    }

    daftarPelamarUpdateProposalStatusNotification.innerHTML = `
    <div class="d-block position-absolute top-0 end-0 start-0 bottom-0 d-flex align-items-center justify-content-center"
                    style="background-color: rgba(0, 0, 0, .4)">
                    <div class="dashboard__logout bg-white p-5" style="width: 500px;">
                        <div class="d-flex flex-column align-items-center justify-content-center position-relative">
                            <span class="fw-700 d-block">${title}</span>
                            <div class="text-center" style="font-size: .85rem;">${message}</div>
                            <img src="${image}" alt="" class="daftar-pelamar__update-proposal-notification-img position-absolute">
                            <button onclick="updateProposalStatusNotification()"
                                class="border border-0 bni-blue text-white d-block mx-auto fw-700 mt-4"
                                style="width: 120px; padding: 6px 10px; border-radius: 10px; font-size: .9rem">Tutup</button>
                        </div>
                    </div>
                </div>
    
    `;
}

function showDeleteApplicant(id) {
    if (daftarPelamarHapusPelamar.textContent.trim() !== "") {
        daftarPelamarHapusPelamar.textContent = "";
        return;
    }

    daftarPelamarHapusPelamar.innerHTML = `
        <div id="logout-notification"
                    class="d-block position-absolute top-0 end-0 start-0 bottom-0 d-flex align-items-center justify-content-center"
                    style="background-color: rgba(0, 0, 0, .4)">
                    <div class="dashboard__logout bg-white" style="width: 500px;">
                        <div class="d-flex">
                            <button onclick="showDeleteApplicant()"
                                class="dashboard__close-btn ms-auto bni-blue text-white border border-0">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </div>
                        <div class="py-3 px-5">
                            <span class="fw-700 text-center d-block" style="font-size: .9rem;">Apakah anda yakin ingin menghapus kandidat tidak berguna ini?</span>
                            <button onclick="processDeleteApplicant(${id})"
                                class="border border-0 bni-blue text-white d-block mx-auto fw-700 mt-4"
                                style="width: 120px; padding: 6px 10px; border-radius: 10px; font-size: .9rem">Hapus</button>
                        </div>
                    </div>
                </div>
    `;
}

function processDeleteApplicant(id) {
    alert("Processing delete applicant")
}
/**
 * function for profile company
 */
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

/**
 * variable for admin dashboard
 */
const adminManageVacancyDetail = document.querySelector("#admin-manage-vacancy-detail")
const adminManageVacancyDetailForm = document.querySelector("#admin-manage-vacancy-detail-form");
const adminManageVacancyDetailInput = document.querySelector("#admin-manage-vacancy-detail-input");
const adminManageVacancyDetailDescription = document.querySelector("#admin-manage-vacancy-detail-description");
const adminManageVacancyDetailLogo = document.querySelector("#admin-manage-vacancy-detail-logo");
const adminManageVacancyDetailNextBtn = document.querySelector("#admin-manage-vacancy-next-btn");
const adminManageVacancyDetailEditBtn = document.querySelector("#admin-manage-vacancy-edit-btn");
const adminManageVacancyNotification = document.querySelector("#admin-manage-vacancy-notification");
const adminManageVacancyVerifyBtn = document.querySelector("#admin-manage-vacancy-verify-btn");
const adminManageVacancyVerify = document.querySelector("#admin-manage-vacancy-verify");
const adminManageVacancyVerifyNotification = document.querySelector("#admin-manage-vacancy-verify-notification");

/**
 * function for admin manage vacancy
 */
function showAdminManageVacancyDetail(id) {
    if (adminManageVacancyDetail.classList.contains("d-block")) {
        adminManageVacancyDetail.classList.remove("d-block");
        adminManageVacancyDetail.classList.add("d-none");

        return;
    }

    adminManageVacancyDetail.classList.remove("d-none");
    adminManageVacancyDetail.classList.add("d-block");

    // do fetch data related to id in the database

    // assigned each value to their corresponding input element
    document.querySelector("#admin-manage-vacancy-salary").value = "2.500.000";
    document.querySelector("#admin-manage-vacancy-salary-type").value = "day";
    document.querySelector("#admin-manage-vacancy-title").value = "Frontend Developer";
    document.querySelector("#admin-manage-vacancy-major").value = "Teknik Informatika";
    document.querySelector("#admin-manage-vacancy-location").value = "Batam, Indonesia";
    document.querySelector("#admin-manage-vacancy-open").value = "2000-12-04";
    document.querySelector("#admin-manage-vacancy-close").value = "2000-12-10";

    let timeTypes = document.querySelectorAll("#admin-manage-vacancy-time-type input");
    timeTypes.forEach(value => {
        if (value.id === "full time") {
            value.checked = true;
            return;
        }
    });

    let typeChildren = document.querySelector("#admin-manage-vacancy-type").children;
    for (child of typeChildren) {
        if (child.value === "offline") {
            child.selected = true;
            break;
        }
    }

    document.querySelector("#admin-manage-vacancy-duration").value = "2 months";
    document.querySelector("#admin-manage-vacancy-quota").value = "18 Quota";
    document.querySelector("#admin-manage-vacancy-description").textContent = "helloworld";
    document.querySelector("#admin-manage-vacancy-old-logo").value = "logo.png";
    document.querySelector("#admin-manage-vacancy-edit-btn").setAttribute('onclick', `processAdminManageVacancyEdit(${id})`);
    document.querySelector("#admin-manage-vacancy-verify-btn").setAttribute('onclick', `showAdminManageVacancyVerify(${id})`);
}

function backAdminManageVacancyDetail() {
    if (adminManageVacancyDetailEditBtn.classList.contains("d-none")) {
        adminManageVacancyDetail.classList.remove("d-block");
        adminManageVacancyDetail.classList.add("d-none");

        return;
    }

    if (adminManageVacancyDetailEditBtn.classList.contains("d-block")) {
        adminManageVacancyDetailEditBtn.classList.remove("d-block");
        adminManageVacancyDetailEditBtn.classList.add("d-none");

        adminManageVacancyDetailNextBtn.classList.remove("d-none");
        adminManageVacancyDetailNextBtn.classList.add("d-block");

        adminManageVacancyVerifyBtn.classList.remove("d-block");
        adminManageVacancyVerifyBtn.classList.add("d-none");

        adminManageVacancyDetailInput.classList.remove("d-none");
        adminManageVacancyDetailInput.classList.add("d-block");

        adminManageVacancyDetailDescription.classList.remove("d-none");
        adminManageVacancyDetailDescription.classList.add("d-block");

        adminManageVacancyDetailLogo.classList.remove("d-block");
        adminManageVacancyDetailLogo.classList.add("d-none");
    }
}

function nextAdminManageVacancyDetail() {
    if (adminManageVacancyDetailEditBtn.classList.contains("d-none")) {
        adminManageVacancyDetailEditBtn.classList.remove("d-none");
        adminManageVacancyDetailEditBtn.classList.add("d-block");

        adminManageVacancyDetailNextBtn.classList.remove("d-block");
        adminManageVacancyDetailNextBtn.classList.add("d-none");

        adminManageVacancyVerifyBtn.classList.remove("d-block");
        adminManageVacancyVerifyBtn.classList.remove("d-none");

        adminManageVacancyDetailInput.classList.remove("d-block");
        adminManageVacancyDetailInput.classList.add("d-none");

        adminManageVacancyDetailDescription.classList.remove("d-block");
        adminManageVacancyDetailDescription.classList.add("d-none");

        adminManageVacancyDetailLogo.classList.remove("d-none");
        adminManageVacancyDetailLogo.classList.add("d-block");
    }
}

function showAdminManageVacancyNotification(message, image) {
    if (adminManageVacancyNotification.classList.contains("d-block")) {
        adminManageVacancyNotification.classList.remove("d-block");
        adminManageVacancyNotification.classList.add("d-none");

        adminManageVacancyDetailEditBtn.classList.remove("d-block");
        adminManageVacancyDetailEditBtn.classList.add("d-none");

        adminManageVacancyVerifyBtn.classList.remove("d-block");
        adminManageVacancyVerifyBtn.classList.add("d-none");

        adminManageVacancyDetailNextBtn.classList.remove("d-none");
        adminManageVacancyDetailNextBtn.classList.add("d-block");

        adminManageVacancyDetailLogo.classList.remove("d-block");
        adminManageVacancyDetailLogo.classList.add("d-none");

        adminManageVacancyDetailInput.classList.remove("d-none");
        adminManageVacancyDetailInput.classList.add("d-block");

        adminManageVacancyDetailDescription.classList.remove("d-none");
        adminManageVacancyDetailDescription.classList.remove("d-block");

        adminManageVacancyDetail.classList.remove("d-block");
        adminManageVacancyDetail.classList.add("d-none");

        adminManageVacancyDetailForm.reset();
        return;
    }


    document.querySelector("#admin-manage-vacancy-notification-title").textContent = message;
    document.querySelector("#admin-manage-vacancy-notification-image").src = image;

    adminManageVacancyNotification.classList.remove("d-none");
    adminManageVacancyNotification.classList.add("d-block");
}

function showAdminManageVacancyVerifyNotification(message, image) {
    if (adminManageVacancyVerifyNotification.classList.contains("d-block")) {
        adminManageVacancyVerifyNotification.classList.remove("d-block");
        adminManageVacancyVerifyNotification.classList.add("d-none");

        adminManageVacancyDetailEditBtn.classList.remove("d-block");
        adminManageVacancyDetailEditBtn.classList.add("d-none");

        adminManageVacancyVerifyBtn.classList.remove("d-block");
        adminManageVacancyVerifyBtn.classList.add("d-none");

        adminManageVacancyDetailNextBtn.classList.remove("d-none");
        adminManageVacancyDetailNextBtn.classList.add("d-block");

        adminManageVacancyDetailLogo.classList.remove("d-block");
        adminManageVacancyDetailLogo.classList.add("d-none");

        adminManageVacancyDetailInput.classList.remove("d-none");
        adminManageVacancyDetailInput.classList.add("d-block");

        adminManageVacancyDetailDescription.classList.remove("d-none");
        adminManageVacancyDetailDescription.classList.remove("d-block");

        adminManageVacancyVerify.classList.remove("d-block")
        adminManageVacancyVerify.classList.add("d-none")


        adminManageVacancyVerifyNotification.classList.remove("d-block");
        adminManageVacancyVerifyNotification.classList.add("d-none");

        adminManageVacancyDetail.classList.remove("d-block");
        adminManageVacancyDetail.classList.add("d-none");

        adminManageVacancyDetailForm.reset();
        return;
    }

    document.querySelector("#admin-manage-vacancy-verify-notification-title").textContent = message;
    document.querySelector("#admin-manage-vacancy-verify-notification-image").src = image;

    adminManageVacancyVerifyNotification.classList.remove("d-none");
    adminManageVacancyVerifyNotification.classList.add("d-block");
}

function showAdminManageVacancyVerify(id) {
    if (adminManageVacancyVerify.classList.contains("d-block")) {
        adminManageVacancyVerify.classList.remove("d-block");
        adminManageVacancyVerify.classList.add("d-none");
        return;
    }

    adminManageVacancyVerify.classList.remove("d-none");
    adminManageVacancyVerify.classList.add("d-block");

    document.querySelector("#admin-manage-vacancy-verify-btn-action").setAttribute("onclick", `processAdminManageVacancyVerify(${id})`);
}

function processAdminManageVacancyEdit(id) {
    // do edit vacancy logic here and return message data

    showAdminManageVacancyNotification("Lowongan berhasil diperbaharui!", "http://localhost:8000/storage/svg/success-checkmark.svg");
}

function processAdminManageVacancyVerify(id) {
    // do verify vacancy logic here and return message data

    showAdminManageVacancyVerifyNotification("Lowongan gagal diverifikasi!", "http://localhost:8000/storage/svg/failed-x.svg");
}