const manageVacancyContainer = $("#manage-vacancy-detail");
let manageVacancyForm = null;
let manageVacancyNotification = null;

// function untuk menampilkan semua lowongan yang di publish
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


function showDetailManageVacancy(id = 0) {
    if (manageVacancyContainer.text().trim() !== '') {
        manageVacancyContainer.trim("");
        manageVacancyContainer.addClass("d-none");

        return;
    }

    manageVacancyContainer.removeClass("d-none");

    $.ajax({
        url: `/dashboard/perusahaan/kelola/lowongan/${id}`,
        method: "GET",
        headers: { "X-GET-DATA": "specific-data"},
        success: function (response) {
            console.log(response)
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

            if (jqXHR.status === 403) {
                let currentUrl = window.location.href;
                let currentPath = window.location.pathname;
                let url = currentUrl.split(currentPath);
                url[1] = 'signin';

                url = url.join('/');
                window.location.replace(url);
                return false;
            }
        }
    });
}

// function untuk menampilkan detail lowongan yang di publish
// async function showManageVacancyCard_old(id = 0) {
//     if (manageVacancyContainer.text().trim() !== '') {
//         manageVacancyContainer.trim("");
//         manageVacancyContainer.addClass("d-none");

//         return;
//     }

//     manageVacancyContainer.removeClass("d-none");

//     try {
//         const response = await fetch(`/dashboard/perusahaan/kelola/lowongan/${id}`, {
//             method: "GET",
//             headers: {
//                 "X_GET_SPECIFIC": "specific-data"
//             }
//         });

//         const result = await response.json();

//         manageVacancyContainer.innerHTML = `
//                 <form id="manage-vacancy-form" method="POST" enctype="multipart/form-data"
//                     class="dashboard__manage-vacancy-form bg-white p-4 d-flex align-items-center justify-content-center gap-4 mt-3 position-relative">
//                     <div id="manage-vacancy-input" class="w-50 d-block">
//                         <div class="dashboard__manage-vacancy-input">
//                             <label for="gaji">Gaji</label>
//                             <div>
//                                 <input type="text" style="width: 120px" class="focus-ring" name="salary"
//                                     value="${result.data.salary}">
//                                 <span class="mx-2">/</span>
//                                 <input type="text" style="width: 120px;" class="focus-ring" name="salary-type"
//                                     value="bulan">
//                             </div>

//                             <label for="judul" class="fw-600">Judul</label>
//                             <input type="text" name="title" class="focus-ring" value="${result.data.title}">

//                             <label for="jurusan" class="fw-600">Jurusan</label>
//                             <select id='manage-vacancy-major-list' name="major" id="jurusan"
//                                 class="bg-white border border-0 cursor-pointer focus-ring">
//                                 <option value="teknik informatika">Teknik Informatika</option>
//                                 <option value="teknik elektro">Teknik Elekro</option>
//                                 <option value="teknik mesin">Teknik Mesin</option>
//                                 <option value="manajemen bisnis">Manajemen Bisnis</option>
//                             </select>

//                             <label for="lokasi" class="fw-600">Lokasi</label>
//                             <input type="text" name="location" class="focus-ring" value="${result.data.location}">

//                             <label for="dibuka" class="fw-600">Dibuka</label>
//                             <div>
//                                 <input type="date" style="width: 120px" value="${result.data.date_created}" class="focus-ring" name="date_created">
//                                 <span class="mx-2">-</span>
//                                 <input type="date" style="width: 120px;" value="${result.data.date_ended}" class="focus-ring" name="date_ended">
//                             </div>

//                             <label for="tipe-waktu" class="fw-600">Tipe waktu</label>
//                             <div>
//                                 <div>
//                                     <input type="radio" name="time_type" id="full-time" value="full time">
//                                     <label for="full-time">Full time</label>
//                                 </div>
//                                 <div>
//                                     <input type="radio" name="time_type" value="part time"
//                                         id="part-time">
//                                     <label for="part-time">Part time</label>
//                                 </div>
//                             </div>

//                             <label for="jenis" class="fw-600">Jenis</label>
//                             <select name="type" id="manage-vacancy-type-list"
//                                 class="focus-ring bg-white border border-0 cursor-pointer">
//                                 <option value="online">Online</option>
//                                 <option value="offline">Offline</option>
//                             </select>

//                             <label for="durasi" class="fw-600">Durasi</label>
//                             <div>
//                                 <input type="text" name="duration" style='width: 100px;' class="focus-ring me-2" value="${result.data.duration}">
//                                 <span>/ Bulan</span>
//                             </div>

//                             <label for="pendaftar" class="fw-600">Quota</label>
//                             <div>
//                                 <input type="text" name="quota" id="" value="${result.data.quota}"
//                                     class="focus-ring me-2" style="width: 100px;">
//                                 <span>/ Pelamar</span>
//                             </div>
//                         </div>
//                     </div>
//                     <div id="manage-vacancy-detail" class="w-50 d-block">
//                         <label for="detail-lowongan" class="fw-600 d-block">Detail lowongan</label>
//                         <textarea name="description" id="" class="dashboard__manage-vacancy-textarea border border-0 p-3">${result.data.description}</textarea>
//                     </div>
//                     <div class="position-absolute bottom-0 start-0 end-0 py-3 px-4 d-flex justify-content-between">
//                         <button id="manage-vacancy-back-form" class="border border-0 bni-blue text-white fw-700"
//                             onclick="showManageVacancyCard()" type="button">Tutup</button>
//                         <div class="d-flex gap-2">
//                             <button id="manage-vacancy-submit" class="border border-0 bni-blue text-white fw-700"
//                                 onclick="deleteManageVacancy(${result.data.id_vacancy}, '${result.data.company.nib}')" type="button">Delete</button>
//                             <button id="manage-vacancy-submit" class="border border-0 bni-blue text-white fw-700"
//                                 onclick="editManageVacancy()" type="button">Edit</button>
//                         </div>
//                     </div>
//                     <input type="hidden" name="id_vacancy" value="${result.data.id_vacancy}">
//                     <input type="hidden" name="nib" value="${result.data.company.nib}">
//                 </form>

//                 <div id="manage-vacancy-notification"
//                     class="d-none dashboard__manage-vacancy-notification position-absolute bg-white p-4 mt-3 d-flex flex-column align-items-center justify-content-center">
//                     <h5 id="manage-vacancy-notification-title" class="fw-700">Perubahan berhasil di simpan!</h5>
//                     <img src="" alt="" id="manage-vacancy-notification-icon" class="fw-700">
//                     <button class="border border-0 bni-blue text-white fw-700 position-relative"
//                         onclick="showManageVacancyCardNotification()">Tutup</button>
//                 </div>
//     `;

//         const majorList = document.querySelector("#manage-vacancy-major-list").children;
//         for (let major of majorList) {
//             if (result.data.major === major.value) {
//                 major.selected = true;
//                 break;
//             }
//         }

//         const timeTypeList = document.querySelectorAll('input[name="time_type"]');
//         timeTypeList.forEach(element => {
//             if (result.data.time_type === element.value) {
//                 element.checked = true;
//                 return;
//             }
//         });

//         const typeList = document.querySelector("#manage-vacancy-type-list").children;
//         for (let type of typeList) {
//             if (result.data.type === type.value) {
//                 type.selected = true;
//                 break;
//             }
//         }

//         manageVacancyForm = document.querySelector("#manage-vacancy-form");
//         manageVacancyNotification = document.querySelector("#manage-vacancy-notification");

//     } catch (error) {
//         console.error("Error: ", error.message);
//     }
// }

// function untuk menampilkan notifikasi brhasil atau tidak edit lowongan
function showManageVacancyCardNotification(message, icon) {
    if (manageVacancyNotification.classList.contains("d-block")) {
        manageVacancyNotification.classList.remove("d-block");
        manageVacancyNotification.classList.add("d-none");

        manageVacancyForm.remove();

        manageVacancyContainer.textContent = '';
        manageVacancyContainer.classList.add("d-none");

        return;
    }

    const notificationTitle = document.querySelector("#manage-vacancy-notification-title");
    const notificationIcon = document.querySelector("#manage-vacancy-notification-icon");

    notificationTitle.textContent = message;
    notificationIcon.src = icon;

    manageVacancyNotification.classList.remove("d-none");
    manageVacancyNotification.classList.add("d-block");

    return;
}

// function untuk edit data lowongan ke server
async function editManageVacancy(id = 0) {
    try {
        const form = new FormData(manageVacancyForm);
        const response = await fetch('/api/dashboard/perusahaan/kelola/lowongan/edit', {
            method: "POST",
            headers: {
                "X_CSRF_TOKEN": window.laravel.csrf_token,
            },
            body: form
        });

        const result = await response.json();
        showManageVacancyCardNotification(result.notification.message, result.notification.icon);
    } catch (error) {
        console.error("Error: ", error.message);
    }
}

// function untuk hapus data lowongan di database
async function deleteManageVacancy(id = 0, nib = "") {
    try {
        const response = await fetch('/api/dashboard/perusahaan/kelola/lowongan/delete', {
            method: "POST",
            headers: {
                "X_CSRF_TOKEN": window.laravel.csrf_token,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ "id_vacancy": id, "nib": nib })
        });

        const result = await response.json();
        showManageVacancyCardNotification(result.notification.message, result.notification.icon);
    } catch (error) {
        console.error("Error: ", error.message);
    }
}