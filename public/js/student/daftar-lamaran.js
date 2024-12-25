const studentAppliedVacancyStatus = document.querySelector("#applied-vacancy-status");
const studentAppliedVacancyStatusInfo = document.querySelector("#apply-status-info");
const studentAppliedVacancyDetail = document.querySelector("#student-applied-vacancy-detail");

// function untuk menampilkan detail lowongan yand dilamar
function showAppliedVacancyDetail(id) {
    if (studentAppliedVacancyDetail.classList.contains("d-block")) {
        studentAppliedVacancyDetail.classList.remove("d-block");
        studentAppliedVacancyDetail.classList.add("d-none", "pe-none");

        return 1;
    }

    studentAppliedVacancyDetail.classList.remove("d-none", "pe-none");
    studentAppliedVacancyDetail.classList.add("d-block");
}

// function untuk menampilkan opsi pilihan lihat status lowongan yand dilamar
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

// function untuk mengambil status informasi lamaran diterima atau tidak
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

// function untuk mengambil status informasi interview diterima atau tidak dan tanggal nya
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

// fucntion untuk menutup semua tampilan
function closeStatusInfo() {
    studentAppliedVacancyStatusInfo.innerHTML = '';
}