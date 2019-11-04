particlesJS.load('particles-js', 'particles.json');

$("#footer-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

$(".rotate").click(function () {
    $(this).toggleClass("down");
});

const hamburger = document.querySelector(".hamburger");
hamburger.addEventListener("click", function () {
    hamburger.classList.toggle("is-active");
});
