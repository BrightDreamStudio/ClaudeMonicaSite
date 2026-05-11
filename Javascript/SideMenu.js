const openMenuBtn = document.getElementById('openMenuBtn');
const closeMenuBtn = document.getElementById('closeMenuBtn');
const menuLinks = document.querySelectorAll(".menu-links a");
const sideMenu = document.getElementById('sideMenu');

openMenuBtn.addEventListener('click', () => {
    sideMenu.classList.add('open');
});

closeMenuBtn.addEventListener('click', () => {
    sideMenu.classList.remove('open');
});

menuLinks.forEach(link => {
    link.addEventListener("click", () => {
        sideMenu.classList.remove("open");
    });
});
