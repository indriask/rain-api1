const vacancyCardListContainer = document.querySelector("#vacancy-card-list-container");
const vacancyDetailCard = document.querySelector("#vacancy-detail-card");
const vacancyApplyFormContainer = document.querySelector("#vacancy-apply-form-container")
const applyFormNotifcation = document.querySelector("#apply-form-notification");
const vacancyApplyForm = document.querySelector("#vacancy-apply-form");
const cardContainer = document.querySelector("#card-container");

// sekalian ngejalanin request data ke api laravel
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


function showDaftarLamaran(id = null) {
    
    return 1;
}