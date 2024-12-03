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

    if (studentAppliedVacancyStatus.innerHTML.trim() === "") {
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
    // do fetch to database first

    fetch("/dashboard/mahasiswa/daftar-lamaran/lamaran", {
        method: "GET",
        headers: {
            "X-CSRF-TOKEN": window.laravel.csrf_token
        },
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
    // do fetch to database first

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
}

function closeStatusInfo() {
    studentAppliedVacancyStatusInfo.innerHTML = '';
}

/**
 * Function for student profile
 */

function showEditProfileNotification() {
    if(editProfileNotification.classList.contains("d-block")) {
        editProfileNotification.classList.remove("d-block");
        editProfileNotification.classList.add("d-none");

        return;
    }

    editProfileNotification.classList.remove("d-none");
    editProfileNotification.classList.add("d-block");
}

function setProfileData() {
    let form = new FormData(editProfileForm);

    // the value of this variabel come from fetch result
    profileEditNotificationTitle.textContent = "Profil berhasil diperbarui!";
    profileEditNotificationImg.src = "http://localhost:8000/storage/svg/success-checkmark.svg";

    showEditProfileNotification();

    // fetch('/test', {
    //     method: "POST",
    //     headers: {
    //         "X-CSRF-TOKEN": window.laravel.csrf_token
    //     },
    //     body: form
    // })
    // .then(response => response.json())
    // .then(data => console.log(data))
}

function showDeleteAccountCard() {
    if(deleteAccountNotification.classList.contains("d-block")) {
        deleteAccountNotification.classList.remove("d-block");
        deleteAccountNotification.classList.add("d-none");

        return;
    }

    deleteAccountNotification.classList.remove("d-none");
    deleteAccountNotification.classList.add("d-block");
}

function processDeleteAccountRequest() {
    // kode yang isi request untuk menghapus akun
}

function showLogoutCard() {
    if(logoutNotification.classList.contains("d-block")) {
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
    if(addVacancy.classList.contains("d-block")) {
        addVacancy.classList.remove("d-block");
        addVacancy.classList.add("d-none");

        return;
    }

    addVacancy.classList.remove("d-none");
    addVacancy.classList.add("d-block");
}

function showAddVacancyInput() {
    if(addVacancyInput.classList.contains("d-block")) {
        addVacancyInput.classList.remove("d-block");
        addVacancyInput.classList.add("d-none");

        return;
    }

    addVacancyInput.classList.remove("d-none");
    addVacancyInput.classList.add("d-block");
}

function showAddVacancyDetail() {
    if(addVacancyDetail.classList.contains("d-block")) {
        addVacancyDetail.classList.remove("d-block");
        addVacancyDetail.classList.add("d-none");
        
        return;
    }

    addVacancyDetail.classList.remove("d-none");
    addVacancyDetail.classList.add("d-block");
}

function backAddVacancyForm() {
    if( addVacancyInput.classList.contains("d-none") && addVacancyDetail.classList.contains("d-none")) {
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
    if(addVacancyInput.classList.contains("d-block") && addVacancyDetail.classList.contains("d-block")) {
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
    
    fetch('/test', {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": window.laravel.csrf_token
        },
        body: form
    })
    .then(response => response.json())
    .then(data => {
        showAddVacancyNotification("Lowongan anda berhasil di ekspos!", "http://localhost:8000/storage/svg/success-checkmark.svg");
    });
    
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
    if(manageVacancyContainer.classList.contains("d-block")) {
        manageVacancyContainer.classList.remove("d-block");
        manageVacancyContainer.classList.add("d-none");
        
        return;
    }

    manageVacancyContainer.classList.remove("d-none");
    manageVacancyContainer.classList.add("d-block");

    return 1;
}

function nextManageVacancyForm() {
    if(manageVacancyInput.classList.contains("d-block") && manageVacancyDetail.classList.contains("d-block")) {
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

    if(manageVacancyLogo.classList.contains("d-none")) {
        manageVacancyContainer.classList.remove("d-block");
        manageVacancyContainer.classList.add("d-none");

        return;
    }

    if(manageVacancyLogo.classList.contains("d-block")) {
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
    showManageVacancyCardNotification("Perubahan gagal di simpan", "http://localhost:8000/storage/svg/failed-x.svg");
}

/**
 * Function for proposal card list
 */