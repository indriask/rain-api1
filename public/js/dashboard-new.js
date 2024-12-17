$(document).ready(function () {
    // Ambil daftar jurusan dari server
    $.getJSON('/jurusan', function (data) {
        let jurusanSelect = $('#jurusan');
        jurusanSelect.empty().append('<option value="">Pilih jurusan</option>');
        data.forEach(function (jurusan) {
            jurusanSelect.append(`<option value="${jurusan.id}">${jurusan.name}</option>`);
        });
    });

    // Ketika jurusan dipilih, ambil daftar prodi
    $('#jurusan').on('change', function () {
        let idJurusan = $(this).val();
        console.log(idJurusan);
        let prodiSelect = $('#prodi');
        prodiSelect.empty().append('<option value="">Pilih prodi</option>');
        if (idJurusan) {
            $.getJSON(`/prodi/${idJurusan}`, function (data) {
                data.forEach(function (prodi) {
                    prodiSelect.append(
                        `<option value="${prodi.id}">${prodi.name}</option>`);
                });
            });
        }
    });

    $.getJSON('/lokasi', function (data) {
        let lokasiSelect = $('#lokasi');
        lokasiSelect.empty().append('<option value="">Pilih Lokasi</option>');

        data.forEach(function (lokasi) {
            lokasiSelect.append(
                `<option value="${lokasi.lokasi}">${lokasi.lokasi}</option>`);
        });
    });
});

function fetchLowongan() {
    const jurusan = $('#jurusan').val();
    const prodi = $('#prodi').val();
    const modeKerja = $('select[name="mode_kerja"]').val();
    const lokasi = $('#lokasi').val();
    const search = $('input[name="cari-perusahaan"]').val();

    $.ajax({
        url: '/lowongan/filter',
        method: 'GET',
        data: {
            jurusan,
            prodi,
            mode_kerja: modeKerja,
            lokasi,
            search,
        },
        success: function (data) {
            const container = $('#data-lowongan');
            container.empty();
            data.forEach((lowong) => {
                // Memformat tanggal
                const tanggal = new Date(lowong.tanggal_pendaftaran);
                const bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
                    "Agustus", "September", "Oktober", "November", "Desember"
                ];
                const tanggalFormat = ("0" + tanggal.getDate()).slice(-2) + "-" + bulan[tanggal
                    .getMonth()] + "-" + tanggal.getFullYear();

                container.append(`
    <div class="vacancy-card bg-white py-3 px-4">
        <div class="d-flex justify-content-between">
            <h5 class="salary-text">Rp. ${lowong.gaji_perbulan.toLocaleString('id-ID')}/bulan</h5>
            <img class="company-photo rounded" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbgAzqz4kY3Lte8GPpOfYnINyvZhPxXl5uSw&s" alt="Company photo">
        </div>
        <div>
            <h6 class="vacancy-role m-0">${lowong.nama_pekerjaan}</h6>
            <span class="vacancy-major-choice">${lowong.jurusan.name}</span>
            <ul class="vacancy-small-detail p-0 mt-3">
                <li><i class="bi bi-geo-alt me-3"></i>${lowong.lokasi}</li>
                <li><i class="bi bi-calendar3 me-3"></i>${tanggalFormat}</li> <!-- Tanggal yang diformat -->
                <li><i class="bi bi-bar-chart-line me-3"></i>${lowong.jumlah_kouta} Kuota</li>
            </ul>
            <ul class="vacancy-small-info mt-4 d-flex justify-content-between">
                <li class="bg-white rounded-pill text-center">${lowong.jenis_kerja}</li>
                <li class="bg-white rounded-pill text-center">${lowong.mode_kerja}</li>
                <li class="bg-white rounded-pill text-center">${lowong.lama_magang} Bulan</li>
            </ul>
            <button onclick="showVacancyDetail('1')"
                class="vacancy-detail border border-0 text-white mx-auto d-block mt">Detail</button>
        </div>
    </div>
`);
            });
        },

    });
}

$('#jurusan, #prodi, select[name="mode_kerja"], #lokasi, input[name="cari-perusahaan"]').on('change keyup',
    fetchLowongan);

$('.hapus-filter').on('click', function () {
    $('#jurusan').val('');
    $('#prodi').val('');
    $('#prodi').find('option').not(':first').remove();
    $('select[name="mode_kerja"]').val('');
    $('#lokasi').val('');
    $('input[name="cari-perusahaan"]').val('');
    fetchLowongan();
});

const vacancyCardListContainer = document.querySelector("#vacancy-card-list-container");
const vacancyDetailCard = document.querySelector("#vacancy-detail-card");
const vacancyApplyFormContainer = document.querySelector("#vacancy-apply-form-container")
const applyFormNotifcation = document.querySelector("#apply-form-notification");
const vacancyApplyForm = document.querySelector("#vacancy-apply-form");
const vacancyCardList = document.querySelector("#vacancy-card-list");
const logoutCard = document.querySelector("#logout-card");

// function untuk mengambil data lowongan dan menampilkanny
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

                            <label class="fw-500">Pendaftar</label>
                            <div class="box">${result.data.applied}</div>
                        </div>
                        <div class="position-absolute bottom-0">
                            <button onclick="showVacancyDetailCard()" type="button"
                                class="close-apply-form text-white fw-700 border border-0">Kembali</button>
                        </div>
                    </div>
                    <div class="w-50">
                        <div class="d-flex">
                            <button type="button"
                            class="apply-vacancy-button border border-0 text-white fw-700 ms-auto"
                            onclick="showApplyVacancyFormContainer(1)">Daftar</button>
                        </div>
                        <h5 class="apply-vacancy-detail-lowongan">Detail Lowongan</h5>
                        <div class="apply-vacancy-detail overflow-auto">${result.data.description}</div>
                    </div>
                </div>
        `;

    } catch (error) {
        console.error("Error: ", error.message);
    }
}

// function untuk meng-aktifkan dan non-aktifkan form daftar lowongan mahasiswa
function showApplyVacancyFormContainer(id) {
    if (vacancyApplyFormContainer.classList.contains("d-block")) {
        vacancyApplyFormContainer.classList.remove("d-block");
        vacancyApplyFormContainer.classList.add("d-none", "pe-none");
        return 1;
    }

    vacancyApplyFormContainer.classList.remove("d-none", "pe-none");
    vacancyApplyFormContainer.classList.add("d-block");
}

// function untuk mengirim data diri mahasiswa ke server
function processAddProposal(id) {
    showNotification();
}

// function untuk menampilkan notifikasi berhasil atau tidaknya pengirim data diri mahasiswa
function showNotification() {
    applyFormNotifcation.classList.remove("d-none", "pe-none");
    applyFormNotifcation.classList.add("d-block");

    vacancyApplyForm.classList.add("d-none", "pe-none");

    return 1;
}

// menutup semua tampilan form daftar lowongan mahasiswa, notifikasi, dan detail lowongan
function closeAllFormCard() {
    applyFormNotifcation.classList.remove("d-block");
    applyFormNotifcation.classList.add("d-none", "pe-none");

    vacancyApplyForm.classList.remove("d-none", "pe-none");

    showApplyVacancyFormContainer();
    showVacancyDetailCard();

    return 1;
}

// function untuk menampilkan pesan ingin logout
function showLogoutCard() {
    if (logoutCard.classList.contains("d-block")) {
        logoutCard.classList.remove("d-block");
        logoutCard.classList.add("d-none");

        return;
    }

    logoutCard.classList.remove("d-none");
    logoutCard.classList.add("d-block");
}

// function untuk request logout ke server
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