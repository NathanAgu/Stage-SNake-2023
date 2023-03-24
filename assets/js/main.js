function menuBurger() {
    let menu = document.querySelector("header");
    menu.classList.toggle("active");
}

document.querySelector("#burgerMenu").addEventListener("click", menuBurger);

function directoryToggle() {
    let dirToggle = document.querySelector(".docBtn");
    dirToggle.classList.toggle("docActive");
}