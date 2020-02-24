$(document).ready(function () {
    // Particles home
    if ($('#particles-home-js').length > 0) {
        particlesJS.load('particles-home-js', app.baseUrl + '/particles-home.json');
    }

    // Particles
    if ($('#particles-js').length > 0) {
        particlesJS.load('particles-js', app.baseUrl + '/particles.json');
    }

    // Birthday input min 18
    if ($('#birthday').length > 0) {
        let today = new Date();
        let dd = today.getDate();
        let mm = today.getMonth() + 1;
        let yyyy = today.getFullYear() - 18;
        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;
        today = yyyy + '-' + mm + '-' + dd;
        $("#birthday").attr("max", today);
    }

    // Btw_nummer input formatting
    if ($('#btw_nummer').length > 0) {
        const element = document.getElementById('btw_nummer');
        const maskOptions = {
            mask: 'NL-00000000-B00',
        };
        IMask(element, maskOptions);
    }

    // Address input formatting
    if ($('#postal').length > 0) {
        const element = document.getElementById('postal');
        const maskOptions = {
            mask: '0000aa',
            prepare: function (str) {
                return str.toUpperCase();
            },
        };
        IMask(element, maskOptions);
    }

    // Submit form profile image select
    if ($('#edit_pf-form').length > 0) {
        document.getElementById("edit_pf").onchange = function () {
            document.getElementById("edit_pf-form").submit();
        };
    }

    // Check captcha
    if ($('#g-recaptcha').length > 0) {
        $(document).on("click", ".btn-disabled", function () {
            alert('Vul de reCAPTCHA in!');
        });
    }
});

// Button captcha complete
function captchaCheck() {
    $('#reg_submit').removeAttr('disabled');
    $('.btn-disabled').remove();
}

// Input file label
// document.getElementById('cv').onchange = function () {
//     alert('Selected file: ' + this.value);
// };

// Validation
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

// Navbar collapse icoon
const hamburger = document.querySelector(".hamburger");
hamburger.addEventListener("click", function () {
    hamburger.classList.toggle("is-active");
});

// Wachtwoord eye icon toggle
$(document).on('click', '.toggle-password', function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    const passIconLog = $("#password_login");
    passIconLog.attr('type') === 'password' ? passIconLog.attr('type', 'text') : passIconLog.attr('type', 'password');

    const passIconZzp = $("#password_zzp");
    passIconZzp.attr('type') === 'password' ? passIconZzp.attr('type', 'text') : passIconZzp.attr('type', 'password');
    const passIconZzpChk = $("#password_zzp_check");
    passIconZzpChk.attr('type') === 'password' ? passIconZzpChk.attr('type', 'text') : passIconZzpChk.attr('type', 'password');

    const passIconBedr = $("#password_bedrijf");
    passIconBedr.attr('type') === 'password' ? passIconBedr.attr('type', 'text') : passIconBedr.attr('type', 'password');
    const passIconBedrChk = $("#password_bedrijf_check");
    passIconBedrChk.attr('type') === 'password' ? passIconBedrChk.attr('type', 'text') : passIconBedrChk.attr('type', 'password');
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

// Max number input in number fields
$('input[type=number]').keyup(function () {
    const min = parseInt($(this).attr('min'));
    const max = parseInt($(this).attr('max')) || 100;
    const val = parseInt($(this).val()) || (min - 1);
    if (val < min) $(this).val(min);
    if (val > max) $(this).val(max);
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