particlesJS.load('particles-js', '../../particles.json');

//Navbar collapse icoon
const hamburger = document.querySelector(".hamburger");
hamburger.addEventListener("click", function () {
    hamburger.classList.toggle("is-active");
});

//Wachtwoord oog icoon toggle
$(document).on('click', '.toggle-password', function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    const input1 = $("#wachtwoord_login");
    input1.attr('type') === 'password' ? input1.attr('type', 'text') : input1.attr('type', 'password');

    const input2 = $("#wachtwoord_reg_zzp1");
    input2.attr('type') === 'password' ? input2.attr('type', 'text') : input2.attr('type', 'password');
    const input3 = $("#wachtwoord_reg_zzp2");
    input3.attr('type') === 'password' ? input3.attr('type', 'text') : input3.attr('type', 'password');

    const input4 = $("#wachtwoord_reg_bedrijf1");
    input4.attr('type') === 'password' ? input4.attr('type', 'text') : input4.attr('type', 'password');
    const input5 = $("#wachtwoord_reg_bedrijf2");
    input5.attr('type') === 'password' ? input5.attr('type', 'text') : input5.attr('type', 'password');
});

//Task filter slider aantal Uren
const UurSlider = document.getElementById("UurSlider");
const UurOutput = document.getElementById("UurOutput");
UurOutput.innerHTML = UurSlider.value;
UurSlider.oninput = function () {
    UurOutput.innerHTML = this.value;
};

//Task filter slider Salaris
const SalSlider = document.getElementById("SalSlider");
const SalOutput = document.getElementById("SalOutput");
SalOutput.innerHTML = SalSlider.value;
SalSlider.oninput = function () {
    SalOutput.innerHTML = this.value;
};