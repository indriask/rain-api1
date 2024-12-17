


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