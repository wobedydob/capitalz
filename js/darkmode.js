(function () {
    const darkSwitch = document.getElementById("darkSwitch");
    if (darkSwitch) {
        initTheme();
        darkSwitch.addEventListener("change", function (event) {
            resetTheme();
        });

        if (localStorage.getItem("darkSwitch") === "dark") {
            $("#toggle-icon").toggleClass("fa-sun");
        } else {
            $("#toggle-icon").toggleClass("fa-moon");
        }

        function initTheme() {
            const darkThemeSelected =
                localStorage.getItem("darkSwitch") !== null &&
                localStorage.getItem("darkSwitch") === "dark";
            darkSwitch.checked = darkThemeSelected;
            darkThemeSelected
                ? document.body.setAttribute("data-theme", "dark")
                : document.body.removeAttribute("data-theme");
        }

        function resetTheme() {
            if (darkSwitch.checked) {
                $("#toggle-icon").toggleClass("fa-sun");
                document.body.setAttribute("data-theme", "dark");
                localStorage.setItem("darkSwitch", "dark");
            } else {
                $("#toggle-icon").toggleClass("fa-moon");
                document.body.removeAttribute("data-theme");
                localStorage.removeItem("darkSwitch");
            }
        }
    }
})();