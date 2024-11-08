const passwordEyeOn = document.querySelectorAll(".bi-eye-slash");
const passwordEyeOff = document.querySelectorAll(".bi-eye");
const passwordInputBar = document.querySelectorAll("input[type='password']");

passwordEyeOn.forEach(function (elem, index) {
    elem.addEventListener("click", function (event) {
        event.target.classList.add("d-none");
        event.target.nextElementSibling.classList.remove("d-none");
    
        passwordInputBar[index].setAttribute('type', 'text');
    });
});

passwordEyeOff.forEach(function (elem, index) {
    elem.addEventListener("click", function (event) {
        event.target.classList.add("d-none");
        event.target.previousElementSibling.classList.remove("d-none");
    
        passwordInputBar[index].setAttribute('type', 'password')
    });
});
