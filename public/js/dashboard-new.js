const vacancyCardListContainer = document.querySelector("#vacancy-card-list-container");
const vacancyDetailCard = document.querySelector("#vacancy-detail-card");
const vacancyApplyFormContainer = document.querySelector("#vacancy-apply-form-container")


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

function showApplyVacancyForm(id) {
    vacancyApplyFormContainer.classList.remove("d-none", "pe-none");
    vacancyApplyFormContainer.classList.add("d-block");

    return 1;
}

function closeApplyVacancyForm() {
    vacancyApplyFormContainer.classList.remove("d-block");
    vacancyApplyFormContainer.classList.add("d-none", "pe-none");

    return 1;
}
