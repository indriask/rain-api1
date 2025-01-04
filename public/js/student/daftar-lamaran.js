const studentAppliedVacancyStatus = document.querySelector("#applied-vacancy-status");
const studentAppliedVacancyStatusInfo = $("#apply-status-info");
const studentAppliedVacancyDetail = $("#student-applied-vacancy-detail");

// function untuk menampilkan detail lowongan yand dilamar
function showAppliedVacancyDetail(id_proposal) {
    if (studentAppliedVacancyDetail.hasClass("d-block")) {
        studentAppliedVacancyDetail.removeClass("d-block");
        studentAppliedVacancyDetail.addClass("d-none");

        return 1;
    }

    studentAppliedVacancyDetail.removeClass("d-none");
    studentAppliedVacancyDetail.addClass("d-block");

    $.ajax({
        url: `/dashboard/mahasiswa/list/lamaran/${id_proposal}`,
        method: 'GET',
        headers: { "GET-DATA": "student-proposal" },
        success: function (response) {
            let vacancy = response.vacancy;
            let firstName = vacancy.company.profile.first_name ?? 'Username';
            let lastName = vacancy.company.profile.last_name ?? '';
            let fullName = `${firstName} ${lastName}`;
            const formatter = new Intl.NumberFormat('en-us', {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0
            });

            const dateCreated = new Date(vacancy.date_created);
            const formattedDateCreated = `${dateCreated.getDate()} ${dateCreated.toLocaleString('en-US', { month: 'short' })} ${dateCreated.getFullYear()}`;
            const dateEnded = new Date(vacancy.date_ended);
            const formattedDateEnded = `${dateEnded.getDate()} ${dateEnded.toLocaleString('en-US', { month: 'short' })} ${dateEnded.getFullYear()}`;
            const endedDateTime = dateEnded.getTime();
            const currentDate = Date.now();
            let status = '';

            if (currentDate > endedDateTime) {
                status = 'Ditutup';
            } else {
                status = 'Dibuka';
            }

            studentAppliedVacancyDetail.html(`
                <div class="apply-form bg-white p-4 d-flex gap-4 mt-3">
                    <div class="position-relative w-50">
                        <h1 class="apply-form-title">${vacancy.title}</h1>
                        <div class="d-flex mt-3">
                            <img class="apply-vacancy-img object-fit-cover object-fit-position me-2"
                                src="${window.storage_path.path + vacancy.company.profile.photo_profile}"
                                alt="">
                            <div style="width: 250px">
                                <div class="apply-company-title d-flex justify-content-between">
                                    <span class="fw-500" style="width: 100px;">${fullName}</span>
                                    <span class="fw-500">${vacancy.location}</span>
                                </div>
                                <div class="apply-vacancy-small-detail d-flex gap-2 mt-1">
                                    <span class="bg-white rounded-pill p-1">${vacancy.type}</span>
                                    <span class="bg-white rounded-pill p-1">${vacancy.time_type}</span>
                                    <span class="bg-white rounded-pill p-1">${vacancy.duration} Bulan</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-input-container mt-4">
                            <label class="fw-500">Gaji</label>
                            <div class="input-group">
                                <div class="box" style="width: 50px;">${formatter.format(vacancy.salary)}</div>
                                <span class="mx-3">/</span>
                                <div class="box" style="width: 30px;">Bulan</div>
                            </div>

                            <label class="fw-500">Jurusan</label>
                            <div class="box">${vacancy.major.name}</div>

                            <label class="fw-500">Dibuka</label>
                            <div class="input-group">
                                <div class="box">${formattedDateCreated}</div>
                                <span class="mx-3">-</span>
                                <div class="box">${formattedDateEnded}</div>
                            </div>

                            <label class="fw-500">Durasi</label>
                            <div class="box">${vacancy.duration} Bulan</div>

                            <label class="fw-500">Kuota</label>
                            <div class="box">${vacancy.quota} Pelamar</div>

                            <label class="fw-500">Pendaftar</label>
                            <div class="box">${vacancy.applied} Pelamar</div>

                            <label class="fw-500">Status</label>
                            <div class="box">${status}</div>
                        </div>
                        <div class="position-absolute bottom-0">
                            <button onclick="showAppliedVacancyDetail()" type="button"
                                class="close-apply-form text-white fw-700 click-animation border border-0 me-2">Kembali</button>
                            <button class="close-apply-form border border-0 click-animation text-white bni-blue fw-700" type="button"
                                onclick="showStudentVacancyStatus(${response.id_proposal})">Cek Status</button>
                        </div>
                    </div>
                    <div class="w-50">
                        <h5 class="apply-vacancy-detail-lowongan">Detail Lowongan</h5>
                        <div class="apply-vacancy-detail overflow-auto">
                            ${vacancy.description}
                        </div>
                    </div>
                </div>
            `);
        },
        error: function (jqXHR) {
            console.log(jqXHR)
        }
    });
}

// function untuk menampilkan opsi pilihan lihat status lowongan yand dilamar
function showStudentVacancyStatus(id_proposal) {
    let template = ''

    if (studentAppliedVacancyStatus.textContent.trim() === "") {
        template = `
                <div
                    class="applied-vacancy-status position-absolute top-0 start-0 end-0 bottom-0 d-flex align-items-center justify-content-center">
                    <div class="status-btn-container bg-white p-5">
                        <div class="d-flex justify-content-between mk">
                            <button onclick="getApplyStatusInfo(${id_proposal})"
                                class="border border-0 text-white fw-500 bni-blue click-animation">LAMARAN</button>
                            <button onclick="getInterviewStatusInfo(${id_proposal})"
                                class="border border-0 text-white click-animation fw-500 bni-blue">WAWANCARA</button>
                        </div>
                        <button class="border border-0 click-animation text-white fw-500 bni-blue d-block mx-auto mt-4 rounded"
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
function getApplyStatusInfo(id_proposal) {
    $.ajax({
        url: "/api/dashboard/mahasiswa/list/lamaran/status/lamaran",
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        data: { id_proposal: id_proposal },
        success: function (response) {
            let notification = response.notification;
            let interviewDate = response.interview_date ?? null;
            let interviewDateNotify = ``;

            if (interviewDate !== null) {
                const date = new Date(interviewDate);

                // Array nama bulan dalam bahasa Indonesia
                const bulanIndonesia = [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ];

                // Ambil bagian tanggal, bulan, tahun, jam, dan menit
                const tanggal = date.getDate();
                const bulan = bulanIndonesia[date.getMonth()];
                const tahun = date.getFullYear();
                const jam = String(date.getHours()).padStart(2, '0');
                const menit = String(date.getMinutes()).padStart(2, '0');

                // Format akhir
                const formattedDate = `${tanggal} ${bulan} ${tahun}, ${jam}:${menit}`;

                interviewDateNotify = `
                <div style="font-size: .9rem;" class="mt-3">
                    <strong >Tanggal wawancara : ${formattedDate}</strong>
                </div>
                `;
            }

            studentAppliedVacancyStatusInfo.html(`
               <div class="position-absolute top-0 start-0 bottom-0 end-0 d-flex align-items-center justify-content-center"
                    style="background-color: rgba(0, 0, 0, .4)">
                    <div class="bg-white rounded d-flex align-items-center justify-content-center flex-column p-5 position-relative"
                        style="width: 500px; border-radius: 15px;">
                        <div class="d-flex align-items-center justify-content-center flex-column position-reltive">
                            <img src="${notification.icon}" alt="" class="position-absolute"
                                style="width: 60px; aspect-ratio: 1/1; opacity: .5; top: 3rem;">
                            <h5 class="fw-700 position-relative z-1">${notification.title}</h5>
                            <span class="text-center position-relative z-1"
                                style="font-size: .8rem">${notification.message}</span>
                        </div> 
                        ${interviewDateNotify}
                        <button class="border border-0 text-white bni-blue fw-700 rounded mt-4"
                            style="width: 100px; padding: 5px; font-size: .9rem"
                            onclick="closeStatusInfo()">Kembali</button>
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
                return;
            }
        }
    })
}

// function untuk mengambil status informasi interview diterima atau tidak dan tanggal nya
function getInterviewStatusInfo(id_proposal) {
    $.ajax({
        url: "/api/dashboard/mahasiswa/list/lamaran/status/wawancara",
        method: "POST",
        headers: { "X-CSRF-TOKEN": window.laravel.csrf_token },
        data: { id_proposal: id_proposal },
        success: function (response) {
            let notification = response.notification;
            studentAppliedVacancyStatusInfo.html(`
                <div class="position-absolute top-0 start-0 bottom-0 end-0 d-flex align-items-center justify-content-center"
                    style="background-color: rgba(0, 0, 0, .4)">
                    <div class="bg-white rounded d-flex align-items-center justify-content-center flex-column p-5 position-relative"
                        style="width: 500px; border-radius: 15px;">
                        <img src="${notification.icon}" alt="" class="position-absolute" style="width: 60px; aspect-ratio: 1/1; opacity: .5; top: 3rem;">
                        <h5 class="fw-700 position-relative z-1">${notification.title}</h5>
                        <span class="text-center position-relative z-1" style="font-size: .8rem">${notification.message}</span>

                        <button class="border border-0 text-white bni-blue fw-700 rounded mt-4"
                            style="width: 100px; padding: 5px; font-size: .9rem"
                            onclick="closeStatusInfo()">Kembali</button>
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
                return;
            }
        }
    });
}

// fucntion untuk menutup semua tampilan
function closeStatusInfo() {
    studentAppliedVacancyStatusInfo.html(``);
}