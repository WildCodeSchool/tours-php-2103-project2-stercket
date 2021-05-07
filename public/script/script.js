const burger = document.querySelector('.hamburger-menu');
const navbar = document.querySelector('.navbar');
const collection = document.getElementById("popup");

burger.addEventListener('click', () => {
    navbar.classList.toggle('active');
});

collection.onclick = () => {
    document.getElementById("showCollection").classList.toggle("show");
};