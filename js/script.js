particlesJS.load('particles-js', 'particles.json');

$("#footer-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

$(".rotate").click(function () {
    $(this).toggleClass("down");
});