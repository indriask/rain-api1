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

function showAddVacancyCard() {
    if(addVacancy.classList.contains("d-block")) {
        addVacancy.classList.remove("d-block");
        addVacancy.classList.add("d-none");

        return;
    }

    addVacancy.classList.remove("d-none");
    addVacancy.classList.add("d-block");
}