const displayFileName = document.querySelector("#display-file-name-container");
const cooperationFileLabel = document.querySelector('#cooperation-file-label');
const cooperationFileInput = document.querySelector('#cooperation-file-input');

const FILE_ICON = {
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document': 'bi-file-earmark-word',
    'application/pdf': 'bi-filetype-pdf'
};


function displayFile() {
    if (cooperationFileLabel.classList.contains("d-none")) {
        cooperationFileLabel.classList.remove("d-none");
        cooperationFileLabel.classList.add("d-block");

        displayFileName.classList.remove("d-block");
        displayFileName.classList.add("d-none");

        cooperationFileInput.value = '';

        return;
    }

    const fileName = cooperationFileInput.files[0].name;
    const fileIcon = cooperationFileInput.files[0].type;

    document.querySelector("#display-file-icon").classList.add("bi", FILE_ICON[fileIcon] !== undefined ? FILE_ICON[fileIcon] : 'bi-file-earmark');
    document.querySelector("#display-file-name").textContent = fileName;


    cooperationFileLabel.classList.remove("d-block");
    cooperationFileLabel.classList.add("d-none");

    displayFileName.classList.remove("d-none");
    displayFileName.classList.add("d-block");
}