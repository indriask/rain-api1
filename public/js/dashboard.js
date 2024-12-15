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
const logoutCard = document.querySelector("#logout-card");

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
 * variable for dashboard home page
 */
const vacancyCardListContainer = document.querySelector("#vacancy-card-list-container");
const vacancyDetailCard = document.querySelector("#vacancy-detail-card");
const vacancyApplyFormContainer = document.querySelector("#vacancy-apply-form-container")
const applyFormNotifcation = document.querySelector("#apply-form-notification");
const vacancyApplyForm = document.querySelector("#vacancy-apply-form");
const vacancyCardList = document.querySelector("#vacancy-card-list");

/**
 * function untuk dashboard home page mahasiswa, perusahaan dan admin
 */
async function getDataOnLoad() {
    try {
        const response = await fetch('/dashboard', {
            method: "GET",
            headers: {
                "X_GET_DATA": "all-data"
            },
        });

        if (!response.ok) {
            throw new Error("Failed to fetch data");
        }

        const result = await response.json();
        const formatter = new Intl.NumberFormat('en-us', {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0
        });

        if (result.data.length === 0 || result.data === undefined) {
            document.querySelector("#empty-data-list-notification").classList.remove("d-none");
            document.querySelector("#empty-data-list-notification-title").textContent = "Data tidak ditemukan, harap coba lagi!";
        } else {
            for (let data of result.data) {
                vacancyCardList.innerHTML += `
                <div class="vacancy-card bg-white py-3 px-4">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="salary-text">${formatter.format(data.salary)}/bulan</h5>
                                        <img class="company-photo rounded"
                                            src="http://localhost:8000/storage${data.company.profile.photo_profile}"
                                            alt="${data.company.profile.first_name} photo">
                                    </div>
                                    <div>
                                        <h6 class="vacancy-role m-0">${data.title}</h6>
                                        <span class="vacancy-major-choice">${data.major}</span>
        
                                        <ul class="vacancy-small-detail p-0 mt-3">
                                            <li><i class="bi bi-geo-alt me-3"></i>${data.location}</li>
                                            <li><i class="bi bi-calendar3 me-3"></i>${data.date_created}</li>
                                            <li><i class="bi bi-bar-chart-line me-3"></i>${data.quota} Kuota</li>
                                        </ul>
        
                                        <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                            <li class="bg-white rounded-pill text-center">${data.time_type}</li>
                                            <li class="bg-white rounded-pill text-center">${data.type}</li>
                                            <li class="bg-white rounded-pill text-center">${data.duration} Bulan</li>
                                        </ul>
        
                                        <button onclick="showVacancyDetailCard(${data.id_vacancy})"
                                            class="vacancy-detail border border-0 text-white mx-auto d-block mt">Detail</button>
                                    </div>
                                </div>
                `;
            }
        }
    } catch (error) {
        console.error("Error: ", error.message);
    }
}

async function showVacancyDetailCard(id = 0) {
    if (vacancyDetailCard.classList.contains("d-block")) {
        vacancyDetailCard.classList.remove("d-block");
        vacancyDetailCard.classList.add("d-none");

        document.querySelector("#vacancy-detail-card-info").remove();

        return 1;
    }

    vacancyDetailCard.classList.remove("d-none");
    vacancyDetailCard.classList.add("d-block");

    try {
        const response = await fetch(`/dashboard/${id}`, {
            method: "GET",
            headers: {
                "X_GET_SPECIFIC": "specific-data"
            }
        });

        if (!response.ok) {
            throw new Error("Failed to fetch data");
        }

        if (response.redirected) {
            window.location.replace('/index');
            return 1;
        }

        let studentForm = '';
        const result = await response.json();

        const formatter = new Intl.NumberFormat('en-us', {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0
        });


        if (result.role === 'student') {
            studentForm = `
                <div class="d-flex">
                <button type="button"
                     class="apply-vacancy-button border border-0 text-white fw-700 ms-auto"
                     onclick="showApplyVacancyFormContainer(1)">Daftar</button>
                </div>
            
            `;
        }

        vacancyDetailCard.innerHTML = `
            <div id="vacancy-detail-card-info" class="apply-form bg-white p-4 d-flex gap-4 mt-3">
                    <div class="position-relative w-50">
                        <h1 class="apply-form-title">${result.data.title}</h1>
                        <div class="d-flex mt-3">
                            <img
                                class="apply-vacancy-img object-fit-cover object-fit-position me-2" src="http://localhost:8000/storage${result.data.company.profile.photo_profile}"
                                alt="Company photo">
                            <div style="width: 250px">
                                <div class="apply-company-title d-flex justify-content-between">
                                    <span class="fw-500" style="width: 100px;">${result.data.company.profile.first_name} ${result.data.company.profile.last_name}</span>
                                    <span class="fw-500">${result.data.location}</span>
                                </div>
                                <div class="apply-vacancy-small-detail d-flex gap-2 mt-1">
                                    <span class="bg-white rounded-pill p-1">${result.data.time_type}</span>
                                    <span class="bg-white rounded-pill p-1">${result.data.type}</span>
                                    <span class="bg-white rounded-pill p-1">${result.data.duration} Bulan/span>
                                </div>
                            </div>
                        </div>

                        <div class="form-input-container mt-4">
                            <label class="fw-500">Gaji</label>
                            <div class="input-group">
                                <div class="box" style="width: 50px;">${formatter.format(result.data.salary)}</div>
                                <span class="mx-3">/</span>
                                <div class="box" style="width: 30px;">${result.data.salary === 0 ? "-" : "bulan"}</div>
                            </div>

                            <label class="fw-500">Jurusan</label>
                            <div class="box">${result.data.major}</div>

                            <label class="fw-500">Dibuka</label>
                            <div class="input-group">
                                <div class="box">${result.data.date_created}</div>
                                <span class="mx-3">-</span>
                                <div class="box">${result.data.date_ended}</div>
                            </div>

                            <label class="fw-500">Kuota</label>
                            <div class="box">${result.data.quota}</div>

                            <label class="fw-500">Status</label>
                            <div class="box">${result.data.status}</div>

                            <label class="fw-500">Pendaftar</label>
                            <div class="box">${result.data.applied}</div>
                        </div>
                        <div class="position-absolute bottom-0">
                            <button onclick="showVacancyDetailCard()" type="button"
                                class="close-apply-form text-white fw-700 border border-0">Kembali</button>
                        </div>
                    </div>
                    <div class="w-50">
                        ${studentForm}
                        <h5 class="apply-vacancy-detail-lowongan">Detail Lowongan</h5>
                        <div class="apply-vacancy-detail overflow-auto">${result.data.description}</div>
                    </div>
                </div>
        `;

    } catch (error) {
        console.error("Error: ", error.message);
    }
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
    if (logoutCard.classList.contains("d-block")) {
        logoutCard.classList.remove("d-block");
        logoutCard.classList.add("d-none");

        return;
    }

    logoutCard.classList.remove("d-none");
    logoutCard.classList.add("d-block");
}

// do logout logic
function processLogoutRequest() {
    fetch('/api/signout', {
        method: "POST",
        headers: {
            X_CSRF_TOKEN: window.laravel.csrf_token
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.code === 302) {
                document.querySelector("#logout-card-message").textContent = data.message;
                document.querySelector("#logout-card-btn").remove();
                document.querySelector("#logout-card-close-btn").remove();

                setTimeout(() => window.location.replace('/index'), 500);
            } else {
                document.querySelector("#logout-card-message").textContent = data.message;
                document.querySelector("#logout-card-btn").remove();
                document.querySelector("#logout-card-close-btn").remove();
            }
        });
}

/**
 * Variable for company add vacancy
 */
let addVacancy = document.querySelector("#add-vacancy");
let addVacancyForm = null;
let addVacancyNotification = null;

/**
 * Function for company add vacancy
 */
function showAddVacancyCard() {
    if (addVacancy.textContent.trim() !== '') {
        addVacancy.textContent = '';
        return;
    }

    addVacancy.innerHTML = `
       <div class="position-absolute top-0 end-0 bottom-0 start-0 d-flex justify-content-center position-relative"
                    style="background-color: rgba(0, 0, 0, .4)">
                    <form method="POST" id="add-vacancy-form" enctype="multipart/form-data"
                        class="dashboard__add-vacancy-company bg-white p-4 d-flex align-items-center justify-content-center gap-4 mt-3 position-relative">
                        <div id="add-vacancy-input" class="w-50 d-block">
                            <div class="dashboard__add-vacancy-form">
                                <label for="gaji" class="fw-600">Gaji</label>
                                <div>
                                    <input type="text" style="width: 120px" class="focus-ring" name="salary">
                                    <span class="mx-2">/</span>
                                    <input type="text" style="width: 120px;" class="focus-ring" value="bulan">
                                </div>

                                <label for="judul" class="fw-600">Judul</label>
                                <input type="text" name="title" class="focus-ring">

                                <label for="major" class="fw-600">Jurusan</label>
                                <select name="major" id="" class="focus-ring bg-white border border-0">
                                    <option value="Teknik Informatika">Teknik Informatika</option>
                                    <option value="Teknik Elektro">Teknik Elektro</option>
                                    <option value="Teknik Mesin">Teknik Mesin</option>
                                    <option value="Manajemen Bisnis">Manajemen Bisnis</option>
                                </select>


                                <label for="lokasi" class="fw-600">Lokasi</label>
                                <input type="text" name="location" class="focus-ring">

                                <label for="dibuka" class="fw-600">Dibuka</label>
                                <div>
                                    <input type="date" style="width: 120px" class="focus-ring" name="date_created">
                                    <span class="mx-2">-</span>
                                    <input type="date" style="width: 120px;" class="focus-ring" name="date_ended">
                                </div>

                                <label for="tipe-waktu" class="fw-600">Tipe waktu</label>
                                <div>
                                    <div>
                                        <input type="radio" name="time_type" id="full-time" value="full time">
                                        <label for="full-time">Full time</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="time_type" value="part time" id="ar">
                                        <label for="part-time">Part time</label>
                                    </div>
                                </div>

                                <label for="jenis" class="fw-600">Jenis</label>
                                <select name="type" id="" class="focus-ring bg-white border border-0">
                                    <option value="online">Online</option>
                                    <option value="offline">Offline</option>
                                </select>

                                <label for="durasi" class="fw-600">Durasi</label>
                                <input type="text" name="duration" class="focus-ring">

                                <label for="pendaftar" class="fw-600">Pendaftar</label>
                                <input type="text" name="quota" id="" class="focus-ring">
                            </div>
                        </div>
                        <div id="add-vacancy-detail" class="w-50 d-block">
                            <label for="detail-lowongan" class="fw-600 d-block">Detail lowongan</label>
                            <textarea name="description" id="" class="dashboard__add-vacancy-textarea border border-0 focus-ring p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, natus numquam. Deserunt debitis sequi fugiat unde, natus non corporis dicta! Repudiandae temporibus sapiente hic iste, eaque eveniet a laboriosam iusto impedit totam. Excepturi, quae nesciunt!</textarea>
                        </div>
                        <div class="position-absolute bottom-0 start-0 end-0 py-3 px-4 d-flex justify-content-between">
                            <button class="border border-0 bni-blue text-white fw-700" onclick="showAddVacancyCard()"
                                type="button">Tutup</button>
                            <button id="add-vacancy-submit" class="d-block border border-0 bni-blue text-white fw-700"
                                onclick="processAddVacancy()" type="button">Ekspos</button>
                        </div>
                    </form>

                    <div id="add-vacancy-notification"
                        class="dashboard__add-vacancy-notification d-none position-absolute bg-white p-4 mt-3 d-flex flex-column align-items-center justify-content-center">
                        <h5 id="add-vacancy-notification-title" class="fw-700"></h5>
                        <img id="add-vacancy-notification-icon" src="" alt="">
                        <button class="border border-0 bni-blue text-white fw-700 position-relative"
                            onclick="closeAddVacancyForm()">Tutup</button>
                    </div>
                </div>
    `;

    addVacancyForm = document.querySelector("#add-vacancy-form");
    addVacancyNotification = document.querySelector("#add-vacancy-notification");

}

async function processAddVacancy() {
    const form = new FormData(addVacancyForm);
    const response = await fetch('/api/dashboard/perusahaan/tambah/lowongan', {
        method: "POST",
        headers: {
            "X_CSRF_TOKEN": window.laravel.csrf_token,
        },
        body: form
    })

    const result = await response.json();
    const formatter = new Intl.NumberFormat('en-us', {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0
    });

    showAddVacancyNotification(result.notification.message, result.notification.icon);

    if (result.success) {
        vacancyCardList.innerHTML += `
        <div class="vacancy-card bg-white py-3 px-4">
                                <div class="d-flex justify-content-between">
                                    <h5 class="salary-text">${formatter.format(result.newData.salary)}/bulan</h5>
                                    <img class="company-photo rounded"
                                        src="http://localhost:8000/storage${result.newData.company.profile.photo_profile}"
                                        alt="${result.newData.company.profile.first_name} photo">
                                </div>
                                <div>
                                    <h6 class="vacancy-role m-0">${result.newData.title}</h6>
                                    <span class="vacancy-major-choice">${result.newData.major}</span>
    
                                    <ul class="vacancy-small-detail p-0 mt-3">
                                        <li><i class="bi bi-geo-alt me-3"></i>${result.newData.location}</li>
                                        <li><i class="bi bi-calendar3 me-3"></i>${result.newData.date_created}</li>
                                        <li><i class="bi bi-bar-chart-line me-3"></i>${result.newData.quota} Kuota</li>
                                    </ul>
    
                                    <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                        <li class="bg-white rounded-pill text-center">${result.newData.time_type}</li>
                                        <li class="bg-white rounded-pill text-center">${result.newData.type}</li>
                                        <li class="bg-white rounded-pill text-center">${result.newData.duration} Bulan</li>
                                    </ul>
    
                                    <button onclick="showVacancyDetailCard(${result.newData.id_vacancy})"
                                        class="vacancy-detail border border-0 text-white mx-auto d-block mt">Detail</button>
                                </div>
                            </div>
        `;
    }
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

    addVacancy.textContent = '';

    addVacancyForm.reset();

    return;
}

/**
 * Variabel for manage vacancy 
 */
const manageVacancyContainer = document.querySelector("#manage-vacancy-container");
let manageVacancyForm = null;
let manageVacancyNotification = null;

/**
 * function for manage vacancy
 */
async function getVacancyDataOnLoad() {
    try {
        const response = await fetch('/dashboard/perusahaan/kelola/lowongan', {
            method: "GET",
            headers: {
                "X_GET_DATA": "all-data"
            }
        });

        if (!response.ok) {
            throw new Error("Failed to fetch data");
        }

        const result = await response.json();
        const formatter = new Intl.NumberFormat('en-us', {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0
        });


        if (result.data.length === 0 || result.data === undefined) {
            document.querySelector("#empty-vacancy-data-notification").classList.remove("d-none");
            document.querySelector("#empty-vacancy-data-notification-title").textContent = "Anda belum mem-publish lowongan apa pun";
        } else {
            for (let data of result.data) {
                vacancyCardList.innerHTML += `
                <div class="vacancy-card bg-white py-3 px-4">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="salary-text">${formatter.format(data.salary)}/bulan</h5>
                                        <img class="company-photo rounded"
                                            src="http://localhost:8000/storage${data.company.profile.photo_profile}"
                                            alt="${data.company.profile.first_name} photo">
                                    </div>
                                    <div>
                                        <h6 class="vacancy-role m-0">${data.title}</h6>
                                        <span class="vacancy-major-choice">${data.major}</span>
        
                                        <ul class="vacancy-small-detail p-0 mt-3">
                                            <li><i class="bi bi-geo-alt me-3"></i>${data.location}</li>
                                            <li><i class="bi bi-calendar3 me-3"></i>${data.date_created}</li>
                                            <li><i class="bi bi-bar-chart-line me-3"></i>${data.quota} Kuota</li>
                                        </ul>
        
                                        <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                                            <li class="bg-white rounded-pill text-center">${data.time_type}</li>
                                            <li class="bg-white rounded-pill text-center">${data.type}</li>
                                            <li class="bg-white rounded-pill text-center">${data.duration} Bulan</li>
                                        </ul>
        
                                        <button onclick="showManageVacancyCard(${data.id_vacancy})"
                                            class="vacancy-detail border border-0 text-white mx-auto d-block mt">Detail</button>
                                    </div>
                                </div>
                `;
            }
        }

    } catch (error) {
        console.error("Error: ", error.message);
    }

}

async function showManageVacancyCard(id = 0) {
    if (manageVacancyContainer.textContent.trim() !== '') {
        manageVacancyContainer.textContent = '';
        manageVacancyContainer.classList.add("d-none");

        return;
    }

    manageVacancyContainer.classList.remove("d-none");

    try {
        const response = await fetch(`/dashboard/perusahaan/kelola/lowongan/${id}`, {
            method: "GET",
            headers: {
                "X_GET_SPECIFIC": "specific-data"
            }
        });

        const result = await response.json();

        manageVacancyContainer.innerHTML = `
     <form id="manage-vacancy-form" method="POST" enctype="multipart/form-data"
                    class="dashboard__manage-vacancy-form bg-white p-4 d-flex align-items-center justify-content-center gap-4 mt-3 position-relative">
                    <div id="manage-vacancy-input" class="w-50 d-block">
                        <div class="dashboard__manage-vacancy-input">
                            <label for="gaji">Gaji</label>
                            <div>
                                <input type="text" style="width: 120px" class="focus-ring" name="salary"
                                    value="${result.data.salary}">
                                <span class="mx-2">/</span>
                                <input type="text" style="width: 120px;" class="focus-ring" name="salary-type"
                                    value="bulan">
                            </div>

                            <label for="judul" class="fw-600">Judul</label>
                            <input type="text" name="title" class="focus-ring" value="${result.data.title}">

                            <label for="jurusan" class="fw-600">Jurusan</label>
                            <select id='manage-vacancy-major-list' name="major" id="jurusan"
                                class="bg-white border border-0 cursor-pointer focus-ring">
                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Teknik Elektro">Teknik Elekro</option>
                                <option value="Teknik Mesin">Teknik Mesin</option>
                                <option value="Manajemen Bisnis">Manajemen Bisnis</option>
                            </select>

                            <label for="lokasi" class="fw-600">Lokasi</label>
                            <input type="text" name="location" class="focus-ring" value="${result.data.location}">

                            <label for="dibuka" class="fw-600">Dibuka</label>
                            <div>
                                <input type="date" style="width: 120px" value="${result.data.date_created}" class="focus-ring" name="date_created">
                                <span class="mx-2">-</span>
                                <input type="date" style="width: 120px;" value="${result.data.date_ended}" class="focus-ring" name="date_ended">
                            </div>

                            <label for="tipe-waktu" class="fw-600">Tipe waktu</label>
                            <div>
                                <div>
                                    <input type="radio" name="time_type" id="full-time" value="full time">
                                    <label for="full-time">Full time</label>
                                </div>
                                <div>
                                    <input type="radio" name="time_type" value="part time"
                                        id="part-time">
                                    <label for="part-time">Part time</label>
                                </div>
                            </div>

                            <label for="jenis" class="fw-600">Jenis</label>
                            <select name="type" id="manage-vacancy-type-list"
                                class="focus-ring bg-white border border-0 cursor-pointer">
                                <option value="online">Online</option>
                                <option value="offline">Offline</option>
                            </select>

                            <label for="durasi" class="fw-600">Durasi</label>
                            <div>
                                <input type="text" name="duration" style='width: 100px;' class="focus-ring me-2" value="${result.data.duration}">
                                <span>/ Bulan</span>
                            </div>

                            <label for="pendaftar" class="fw-600">Quota</label>
                            <div class="d">
                                <input type="text" name="quota" id="" value="${result.data.quota}"
                                    class="focus-ring me-2" style="width: 100px;">
                                <span>/ Pelamar</span>
                            </div>
                        </div>
                    </div>
                    <div id="manage-vacancy-detail" class="w-50 d-block">
                        <label for="detail-lowongan" class="fw-600 d-block">Detail lowongan</label>
                        <textarea name="description" id="" class="dashboard__manage-vacancy-textarea border border-0 p-3">${result.data.description}</textarea>
                    </div>
                    <div class="position-absolute bottom-0 start-0 end-0 py-3 px-4 d-flex justify-content-between">
                        <button id="manage-vacancy-back-form" class="border border-0 bni-blue text-white fw-700"
                            onclick="showManageVacancyCard()" type="button">Tutup</button>
                        <div class="d-flex gap-2">
                            <button id="manage-vacancy-submit" class="border border-0 bni-blue text-white fw-700"
                                onclick="editManageVacancy(1)" type="button">Edit</button>
                        </div>
                    </div>
                    <input type="hidden" name="id_vacancy" value="${result.data.id_vacancy}">
                </form>
                <div id="manage-vacancy-notification"
                    class="d-none dashboard__manage-vacancy-notification position-absolute bg-white p-4 mt-3 d-flex flex-column align-items-center justify-content-center">
                    <h5 id="manage-vacancy-notification-title" class="fw-700">Perubahan berhasil di simpan!</h5>
                    <img src="" alt="" id="manage-vacancy-notification-icon" class="fw-700">
                    <button class="border border-0 bni-blue text-white fw-700 position-relative"
                        onclick="closeManageVacancyForm()">Kembali</button>
                </div>


    `;

        const majorList = document.querySelector("#manage-vacancy-major-list").children;
        for (let major of majorList) {
            if (result.data.major === major.value) {
                major.selected = true;
                break;
            }
        }

        const timeTypeList = document.querySelectorAll('input[name="time_type"]');
        timeTypeList.forEach(element => {
            if (result.data.time_type === element.value) {
                element.checked = true;
                return;
            }
        });

        const typeList = document.querySelector("#manage-vacancy-type-list").children;
        for (let type of typeList) {
            if (result.data.type === type.value) {
                type.selected = true;
                break;
            }
        }

        manageVacancyForm = document.querySelector("#manage-vacancy-form");
        manageVacancyNotification = document.querySelector("#manage-vacancy-notification");

    } catch (error) {
        console.error("Error: ", error.message);
    }
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

async function editManageVacancy(id = 0) {
    try {
        const form = new FormData(manageVacancyForm);
        const response = await fetch('/api/dashboard/perusahaan/kelola/lowongan/edit', {
            method: "POST",
            headers: {
                "X_CSRF_TOKEN": window.laravel.csrf_token
            },
            body: form
        });

        const result = await response.json();

        console.log(result);

    } catch (error) {
        console.error("Error: ", error.message);
    }
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