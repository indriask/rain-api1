const vacancyCardListContainer = document.querySelector("#vacancy-card-list-container");
const vacancyDetailCard = document.querySelector("#vacancy-detail-card");

function showVacancyDetail(id) {
    vacancyDetailCard.classList.remove("d-none", "pe-none");
    vacancyCardListContainer.classList.add("overflow-hidden");

    return 1;
}

function closeVacancyDetail() {
    vacancyDetailCard.classList.add("d-none", "pe-none");
    vacancyCardListContainer.classList.remove("overflow-auto");

    return 1;
}