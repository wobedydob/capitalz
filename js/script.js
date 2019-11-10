particlesJS.load('particles-js', 'particles.json');

const hamburger = document.querySelector(".hamburger");
hamburger.addEventListener("click", function () {
    hamburger.classList.toggle("is-active");
});

$(document).on('click', '.toggle-password', function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    const input = $("#wachtwoord1");
    input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password');
});

function clearSelection() {
    if (document.selection && document.selection.empty) {
        document.selection.empty();
    } else if (window.getSelection) {
        var sel = window.getSelection();
        sel.removeAllRanges();
    }
}