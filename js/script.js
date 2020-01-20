$(document).ready(function () {
    // Particles
    if ($('#particles-js').length > 0) {
        particlesJS.load('particles-js', '../../particles.json');
    }

    // Max datum van vandaag
    if ($('#birthday').length > 0) {
        let today = new Date();
        let dd = today.getDate();
        let mm = today.getMonth() + 1;
        const yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        today = yyyy + '-' + mm + '-' + dd;
        $("#birthday").attr("max", today);
    }

    // Btw_nummer input formatting
    if ($('#btw_nummer').length > 0) {
        const element = document.getElementById('btw_nummer');
        const maskOptions = {
            mask: 'NL-00000000-B00',
        };
        const mask = IMask(element, maskOptions);
    }
});

// Validation
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
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

// Navbar collapse icoon
const hamburger = document.querySelector(".hamburger");
hamburger.addEventListener("click", function () {
    hamburger.classList.toggle("is-active");
});

// Wachtwoord eye icon toggle
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

// TaskPage filter slider aantal Uren
if (document.getElementById("UurSlider") !== null) {
    const UurSlider = document.getElementById("UurSlider");
    const UurOutput = document.getElementById("UurOutput");
    UurOutput.innerHTML = UurSlider.value;
    UurSlider.oninput = function () {
        UurOutput.innerHTML = this.value;
    };
}

// TaskPage filter slider Salaris
if (document.getElementById("SalSlider") !== null) {
    const SalSlider = document.getElementById("SalSlider");
    const SalOutput = document.getElementById("SalOutput");
    SalOutput.innerHTML = SalSlider.value;
    SalSlider.oninput = function () {
        SalOutput.innerHTML = this.value;
    };
}

// Carousel select
$(document).on('click', '.carousel-item', function () {
    $(this).toggleClass("selected");
});

// Load icon
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

// max number input
$(document).on('keyup', 'input[id=work-hours]', function () {
    const _this = $(this);
    const min = parseInt(_this.attr('min')) || 1;
    const max = parseInt(_this.attr('max')) || 100;
    const val = parseInt(_this.val()) || (min - 1);
    if (val < min)
        _this.val(min);
    if (val > max)
        _this.val(max);
});

// max number input
$(document).on('keyup', 'input[id=work-sal]', function () {
    const _this = $(this);
    const min = parseInt(_this.attr('min')) || 1;
    const max = parseInt(_this.attr('max')) || 100;
    const val = parseInt(_this.val()) || (min - 1);
    if (val < min)
        _this.val(min);
    if (val > max)
        _this.val(max);
});

// Ajax input
$('input#search').keyup(function () {
    let input = $(this).val(),
        callback = (function (data) {
            $('overview').html(data);
        });
    //console.log(input);
    cz_ajax('search', {input: input}, callback);
});

// Ajax search
function cz_ajax(func, values, callback) {
    const baseUrl = 'http://www.capitalz.net/ajax/';
    console.log(values);
    $.ajax({
        method: "POST",
        url: baseUrl + func,
        data: values
    }).done(function (data) {
        if (data.length > 0) {
            callback(data);
        } else {
            alert('Er is iets fout gegaan, probeer het opnieuw.');
        }
    });
}