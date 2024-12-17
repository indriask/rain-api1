const daftarPelamarStudentProfile = document.querySelector("#daftar-pelamar-student-profile");
const daftarPelamarProposalInfoContainer = document.querySelector("#daftar-pelamar-proposal-info-container");
const daftarPelamarUpdateProposalStatus = document.querySelector("#daftar-pelamar-update-proposal-status")
const daftarPelamarUpdateOptionProposalStatus = document.querySelector("#daftar-pelamar-update-option-proposal-status");
const daftarPelamarUpdateProposalStatusNotification = document.querySelector("#daftar-pelamar-update-proposal-status-notification");
const daftarPelamarHapusPelamar = document.querySelector("#daftar-pelamar-hapus-pelamar");

// function untuk menampilkan profile mahasiswa
function showStudentProfile() {
    if (daftarPelamarStudentProfile.classList.contains("d-block")) {
        daftarPelamarStudentProfile.classList.remove("d-block");
        daftarPelamarStudentProfile.classList.add("d-none");

        return;
    }

    daftarPelamarStudentProfile.classList.remove("d-none");
    daftarPelamarStudentProfile.classList.add("d-block");
}

// function untuk menampilkan lamaran mahasiswa
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

// function untuk donwload lamaran mahasiswa
function installProposalFiles(id) {
    // do installation on student proposal files
}

// fucntion untuk menampilkan opsi update status lamaran dan interview
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

// function untuk request hapus pelamar ke server
function processDeleteApplicant(id) {
    alert("Processing delete applicant")
}