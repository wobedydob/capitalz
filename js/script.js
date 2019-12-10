//Particles
particlesJS.load('particles-js', '../../particles.json');

//Navbar collapse icoon
const hamburger = document.querySelector(".hamburger");
hamburger.addEventListener("click", function () {
    hamburger.classList.toggle("is-active");
});

//Wachtwoord eye icon toggle
$(document).on('click', '.toggle-password', function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    const passIconLog = $("#wachtwoord_login");
    passIconLog.attr('type') === 'password' ? passIconLog.attr('type', 'text') : passIconLog.attr('type', 'password');

    const passIconRegZzp1 = $("#wachtwoord_reg_zzp1");
    passIconRegZzp1.attr('type') === 'password' ? passIconRegZzp1.attr('type', 'text') : passIconRegZzp1.attr('type', 'password');
    const passIconRegZzp2 = $("#wachtwoord_reg_zzp2");
    passIconRegZzp2.attr('type') === 'password' ? passIconRegZzp2.attr('type', 'text') : passIconRegZzp2.attr('type', 'password');

    const passIconRegBedrijf1 = $("#wachtwoord_reg_bedrijf1");
    passIconRegBedrijf1.attr('type') === 'password' ? passIconRegBedrijf1.attr('type', 'text') : passIconRegBedrijf1.attr('type', 'password');
    const passIconRegBedrijf2 = $("#wachtwoord_reg_bedrijf2");
    passIconRegBedrijf2.attr('type') === 'password' ? passIconRegBedrijf2.attr('type', 'text') : passIconRegBedrijf2.attr('type', 'password');
});

//TaskPage filter slider aantal Uren
if (document.getElementById("UurSlider") !== null) {
    let UurSlider = document.getElementById("UurSlider");
    let UurOutput = document.getElementById("UurOutput");
    UurOutput.innerHTML = UurSlider.value;
    UurSlider.oninput = function () {
        UurOutput.innerHTML = this.value;
    };
}

//TaskPage filter slider Salaris
if (document.getElementById("SalSlider") !== null) {
    const SalSlider = document.getElementById("SalSlider");
    const SalOutput = document.getElementById("SalOutput");
    SalOutput.innerHTML = SalSlider.value;
    SalSlider.oninput = function () {
        SalOutput.innerHTML = this.value;
    };
}

//Terms of Service
(function () {
    'use strict';
    window.addEventListener('load', function () {
        const forms = document.getElementsByClassName('needs-validation');
        Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

//Carousel select
$(document).on('click', '.carousel-item', function () {
    $(this).toggleClass("selected");
});

//Load icon
document.onreadystatechange = function () {
    $("body").css("overflow", "hidden");
    const state = document.readyState;
    if (state === "interactive") {
        document.getElementById("contents").style.visibility = "hidden";
    } else if (state === "complete") {
        setTimeout(function () {
            $("body").css("overflow", "visible");
            document.getElementById("interactive");
            document.getElementById("load").style.visibility = "hidden";
            document.getElementById("contents").style.visibility = "visible";
        }, 100);
    }
};