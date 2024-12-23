$(document).ready(function () {
    $.ajax({
        url: "/dashboard/perusahaan/daftar/pelamar",
        method: "GET",
        headers: { "X-GET-DATA": "get-applicants" },
        success: function (response) {
            const applicantListData = $("#applicant-list-data");
            const applicants = response.applicants;

            for (applicant of applicants) {
                let fullName = `${applicant.student.profile.first_name} ${applicant.student.profile.last_name}`;
                fullName = (fullName.trim() === "") ? "Username" : fullName;

                applicantListData.append(`
                    <div class="daftar-pelamar__proposal-card bg-white p-4 position-relative">
                                    <div onclick="showStudentProfile(${applicant.student.id_profile}, ${applicant.id_proposal})" class="cursor-pointer">
                                        <div class="d-flex align-items-center gap-3 border-bottom border-black pb-2">
                                            <img src="${window.storage_path.path + applicant.student.profile.photo_profile}"
                                                class="daftar-pelamar__proposal-card-profile rounded-pill" alt="">
                                            <div class="d-flex flex-column">
                                                <span class="daftar-pelamar__proposal-card-name fw-700"
                                                    style="font-size: .95rem" title="">${fullName}</span>
                                                <span class="daftar-pelamar__proposal-card-name" style="font-size: .85rem;"
                                                    title="">${applicant.student.account.email}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <span class="daftar-pelamar__proposal-card-name fw-600"
                                                style="font-size: .95rem">${applicant.vacancy.title}</span>
                                            <span><i class="bi bi-folder fw-500" style="font-size: .85rem;"></i> ${applicant.resume.length}</span>
                                        </div>
                                    </div>
                                    <button type="button" onclick="showDeleteApplicant(${applicant.id_proposal})"
                                        class="daftar-pelamar__proposal-card-delete click-animation border border-0 cursor-pointer position-absolute top-0 end-0 bni-blue text-white">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                `);
            }
        },
        error: function (jqXHR) {
            // check apakah response code nya 401 (user tidak ter-autentikasi)
            if (jqXHR.status === 401) {
                let currentUrl = window.location.href;
                let currentPath = window.location.pathname;
                let url = currentUrl.split(currentPath);
                url[1] = 'index';

                url = url.join('/');
                window.location.replace(url);
                return false;
            }

            // check apakah response code nya 403 (akses tidak diizinkan)
            if (jqXHR.status === 403) {
                console.error("Someting when wrong when accesing the page");
                return false;
            }
        }
    });
});

const daftarPelamarStudentProfileContainer = $("#daftar-pelamar-student-profile-container");
const daftarPelamarStudentProfile = $("#daftar-pelamar-student-profile");
const daftarPelamarProposalInfoContainer = $("#daftar-pelamar-proposal-info-container");
const daftarPelamarUpdateProposalStatus = $("#daftar-pelamar-update-proposal-status")
const daftarPelamarUpdateOptionProposalStatus = document.querySelector("#daftar-pelamar-update-option-proposal-status");
const daftarPelamarUpdateProposalStatusNotification = document.querySelector("#daftar-pelamar-update-proposal-status-notification");
const daftarPelamarHapusPelamar = $("#daftar-pelamar-hapus-pelamar");
const deleteApplicantNotification = $("#daftar-pelamar-delete-applicant-notification");
const daftarPelamarCustomNotification = $("#custom-notification");

// function untuk menampilkan profile mahasiswa
function showStudentProfile(id_profile, id_proposal) {
    if (daftarPelamarStudentProfileContainer.hasClass("d-block")) {
        daftarPelamarStudentProfileContainer.removeClass("d-block");
        daftarPelamarStudentProfileContainer.addClass("d-none");

        daftarPelamarStudentProfile.html("");
        return;
    }

    daftarPelamarStudentProfileContainer.removeClass("d-none");
    daftarPelamarStudentProfileContainer.addClass("d-block");

    $.ajax({
        url: `/dashboard/perusahaan/daftar/pelamar/${id_profile}`,
        method: "GET",
        headers: { "X-GET-DATA": "get-applicant-profile" },
        data: { id_profile },
        success: function (response) {
            let profile = response.profile;
            let fullName = `${profile.first_name} ${profile.last_name}`;
            fullName = (fullName.trim() === "") ? "Username" : fullName;

            daftarPelamarStudentProfile.html(`
                <div class="daftar-pelamar__student-profile mx-auto bg-white p-4 d-flex gap-5 mt-3">
                        <div class="profile-info w-50 position-relative">
                            <div class="d-flex align-items-center gap-3">
                                <img src="${window.storage_path.path + profile.photo_profile}"
                                    alt="Someone profile" class="profile__profile-img rounded">
                                <div class="w-100">
                                    <div class="profile__profile-nama-lengkap bg-white rounded p-2">${fullName}
                                    </div>
                                    <span class="fw-700" style="font-size: .9rem">Mahasiswa</span>
                                </div>
                            </div>
                            <div class="profile__profile-more-info mt-4">
                                <label for="asal-institusi" style="font-size: .95rem">Asal institusi</label>
                                <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">${profile.student.institute ?? ""}</div>
    
                                <label for="jurusan" style="font-size: .95rem">Jurusan</label>
                                <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">${profile.student.major.name ?? ""}</div>
    
                                <label for="program-studi" style="font-size: .95rem">Program studi</label>
                                <div class="border border-0 rounded px-2 shadow" style="font-size: .9rem;">${profile.student.study_program.name ?? ""}</div>
    
                                <label for="keahlian" style="font-size: .95rem">Keahlian</label>
                                <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">${profile.skill ?? ""}</div>
    
                                <label for="alamat" style="font-size: .95rem">Alamat</label>
                                <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">${profile.location ?? ""}</div>
    
                                <label for="kota" style="font-size: .95rem">Kota</label>
                                <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">${profile.city ?? ""}</div>
    
                                <label for="kode-pos" style="font-size: .95rem">Kode Pos</label>
                                <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">${profile.postal_code ?? ""}</div>
    
                                <label for="nomor-telepon" style="font-size: .95rem">Nomor telepon</label>
                                <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">${profile.phone_number ?? ""}</div>
    
                                <label for="email" style="font-size: .95rem">Email</label>
                                <div class="border border-0 rounded p-1 px-2 shadow" style="font-size: .9rem;">${profile.student.account.email}</div>
                            </div>
                            <div class="position-absolute" style="bottom: 10px;">
                                <button class="border border-0 bni-blue text-white fw-700 click-animation p-1 rounded me-2"
                                    style="font-size: .9rem; width: 100px;" onclick="showStudentProfile()">Tutup</button>
                                <button class="border border-0 bni-blue text-white fw-700 click-animation p-1 rounded"
                                    style="font-size: .9rem; width: 130px;" onclick="showStudentProposal(${id_proposal})">Lihat
                                    Lamaran</button>
                            </div>
                        </div>
                        <div class="profile__profile-description w-50">
                            <div class="h-100">
                                <span class="fw-700 mb-2 d-block" style="font-size: .9rem">Deskripsi ProfilMahasiswa</span>
                                <div class="bg-white shadow overflow-x-hidden overflow-y-auto px-3 py-2 w-100"
                                    style="font-size: .9rem; height: 500px; text-align: justify; line-height: 1.5rem; border-radius: 20px;">
                                </div>
                            </div>
                        </div>
                    </div>    
            `);
        },
        error: function (jqXHR) {
            if (jqXHR.status === 500) {
                const response = jqXHR.responseJSON.notification;
                showCustomNotification(response.message, response.icon);
                return;
            }

            // error kesalahan pada validasi token CSRF
            if (jqXHR.status === 419) {
                showCustomNotification("Gagal melakukan request, harap coba lagi!", `${window.storage_path.path}svg/failed-x.svg`);
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
                return false;
            }

            // check apakah response code nya 403 (akses tidak diizinkan)
            if (jqXHR.status === 403) {
                showCustomNotification("Gagal menampilkan halaman website, harap coba lagi!", `${window.storage_path.path}svg/failed-x.svg`);
                return false;
            }
        }
    });
}

// function untuk menampilkan lamaran mahasiswa
function showStudentProposal(id_proposal) {
    if (daftarPelamarProposalInfoContainer.hasClass("d-block")) {
        daftarPelamarProposalInfoContainer.removeClass("d-block");
        daftarPelamarProposalInfoContainer.addClass("d-none");

        daftarPelamarProposalInfoContainer.html(``);

        return;
    }

    daftarPelamarProposalInfoContainer.removeClass("d-none");
    daftarPelamarProposalInfoContainer.addClass("d-block");

    $.ajax({
        url: `/dashboard/perusahaan/daftar/pelamar/${id_proposal}`,
        method: "GET",
        headers: { "X-GET-DATA": "get-applicant-proposal" },
        data: { id_proposal },
        success: function (response) {
            let proposal = response.proposal;
            let fullName = `${proposal.student.profile.first_name} ${proposal.student.profile.last_name}`;
            fullName = (fullName.trim() === "") ? "Username" : fullName;

            daftarPelamarProposalInfoContainer.html(`
                <div id="daftar-pelamar-proposal-info-box"
                        class="vacancy-apply-form-card bg-white p-4 position-relative">
                        <div class="position-absolute top-0 end-0">
                            <button class="daftar-pelamar__proposal-info-close click-animation text-white border border-0 bni-blue"
                                onclick="showStudentProposal()"><i class="bi bi-x-circle"></i></button>
                        </div>

                        <div class="d-flex justify-content-between">
                            <h1 class="vacancy-apply-form-card-title fw-700 mb-0">Informasi Lamaran</h1>
                        </div>

                        <div class="apply-form-common-info mt-4">
                            <h5 class="apply-form-common-info-heading fw-700 mb-3">Informasi dasar</h5>

                            <div class="daftar-pelamar__proposal-info-box w-100 border mb-3">${fullName}
                            </div>
                            <div class="daftar-pelamar__proposal-info-box w-100 border mb-3">${proposal.nim}</div>
                            <div class="daftar-pelamar__proposal-info-box w-100 border mb-3">${proposal.student.major.name ?? ""}</div>
                            <div class="daftar-pelamar__proposal-info-box w-100 border mb-3">${proposal.student.study_program.name ?? ""}</div>
                            <div class="daftar-pelamar__proposal-info-box w-100 border mb-3">${proposal.student.account.email}</div>
                            <div class="daftar-pelamar__proposal-info-box w-100 border mb-3">${proposal.student.profile.phone_number ?? ""}</div>
                        </div>

                        <button for="upload-file" onclick="installProposalFiles(${id_proposal})"
                            class="apply-form-upload-file border border-0 click-animation text-white fw-700 text-center w-100">
                            <i class="bi bi-file-earmark-arrow-down me-1"></i> Unduh Dokumen
                        </button>

                        <button type="button" onclick="showUpdateStatusProposal(1)"
                            class="apply-form-common-info-btn border border-0 text-white click-animation fw-700 d-block mx-auto mt-2 text-center px-2"
                            style="width: fit-content;">Perbarui Status Pelamar</button>
                    </div>    
            `);
        },
        error: function (jqXHR) {
            if (jqXHR.status === 500) {
                const response = jqXHR.responseJSON.notification;
                showCustomNotification(response.message, response.icon);
                return;
            }

            // error kesalahan pada validasi token CSRF
            if (jqXHR.status === 419) {
                showCustomNotification("Gagal melakukan request, harap coba lagi!", `${window.storage_path.path}svg/failed-x.svg`);
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

// function untuk donwload lamaran mahasiswa
function installProposalFiles(id_proposal) {
    $.ajax({
        url: `/dashboard/perusahaan/daftar/pelamar/download/${id_proposal}`,
        method: "GET",
        data: { id_proposal },
        success: function (response) {
            if (response.file_error) {
                console.error(response.file_error);

                return;
            }

            if (response.url) {
                const link = document.createElement('a');
                link.href = response.url;
                link.setAttribute('donwload', '');
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                return;
            }
        },
        error: function (jqXHR) {
            if (jqXHR.status === 500) {
                const response = jqXHR.responseJSON.notification;
                showCustomNotification(response.message, response.icon);
                return;
            }

            // error kesalahan pada validasi token CSRF
            if (jqXHR.status === 419) {
                showCustomNotification("Gagal melakukan request, harap coba lagi!", `${window.storage_path.path}svg/failed-x.svg`);
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
    })
}

// fucntion untuk menampilkan opsi update status lamaran dan interview
function showUpdateStatusProposal(id) {
    if (daftarPelamarUpdateProposalStatus.text().trim() !== '') {
        daftarPelamarUpdateProposalStatus.text('');

        return;
    }

    daftarPelamarUpdateProposalStatus.html(`
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
    `);
}

// function untuk menampilkan opsi terima, tinjau, tolak pada lamaran dan interview
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

// function untuk mengirim request update status ke server
function updateStatusProposal(status, id, type) {
    console.log(status, id, type);
    updateProposalStatusNotification('Status berhasil diperbarui!', 'Terjadi kesalahan saat melakukan update data, silahkan coba lagi!', 'http://localhost:8000/storage/svg/success-checkmark.svg');
}

// function untuk menampilkan notifikasi berhasil atau gagal update statua
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

// function untuk menampilkan informasi hapus pelamar
function showDeleteApplicant(id_proposal) {
    if (daftarPelamarHapusPelamar.text().trim() !== "") {
        daftarPelamarHapusPelamar.text("");
        return;
    }

    daftarPelamarHapusPelamar.html(`
        <div id="logout-notification"
                    class="d-block position-absolute top-0 end-0 start-0 bottom-0 d-flex align-items-center justify-content-center"
                    style="background-color: rgba(0, 0, 0, .4)">
                    <div class="dashboard__logout bg-white" style="width: 500px;">
                        <div class="d-flex">
                            <button onclick="showDeleteApplicant()"
                                class="dashboard__close-btn click-animation ms-auto bni-blue text-white border border-0">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </div>
                        <div class="py-3 px-5">
                            <span class="fw-700 text-center d-block" style="font-size: .9rem;">Apakah anda yakin ingin menghapus kandidat ini?</span>
                            <button onclick="processDeleteApplicant(${id_proposal})"
                                class="border border-0 click-animation bni-blue text-white d-block mx-auto fw-700 mt-4"
                                style="width: 120px; padding: 6px 10px; border-radius: 10px; font-size: .9rem">Hapus</button>
                        </div>
                    </div>
                </div>
    `);
}

// function untuk request hapus pelamar ke server
function processDeleteApplicant(id_proposal) {
    $.ajax({
        url: "/api/dashboard/perusahaan/daftar/pelamar/delete",
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        data: { id_proposal },
        success: function (response) {
            console.log(response);
            if (response.success) {
                showDeleteApplicantNotification(response.notification.message, response.notification.icon);
            }

            if (response.error) {
                showDeleteApplicantNotification(response.notification.message, response.notification.icon);
            }
        },
        error: function (jqXHR) {
            if (jqXHR.status === 500) {
                const response = jqXHR.responseJSON.notification;
                showCustomNotification(response.message, response.icon);
                return;
            }

            // error kesalahan pada validasi token CSRF
            if (jqXHR.status === 419) {
                showCustomNotification("Gagal melakukan request, harap coba lagi!", `${window.storage_path.path}svg/failed-x.svg`);
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

function showDeleteApplicantNotification(message, icon) {
    if (deleteApplicantNotification.hasClass("d-block")) {
        deleteApplicantNotification.removeClass("d-block");
        deleteApplicantNotification.addClass("d-none");

        daftarPelamarHapusPelamar.text("");

        return;
    }

    deleteApplicantNotification.removeClass("d-none");
    deleteApplicantNotification.addClass("d-block");

    $("#delete-applicant-notification-message").text(message);
    $("#delete-applicant-notification-icon").attr('src', icon);
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