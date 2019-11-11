<nav class="navbar navbar-expand-lg navbar-expand-md navbar-light">
    <a href="../index.php?content=homepage">
        <div class="logo">
            <?= svg_helper("logo"); ?>
        </div>
    </a>
    <button class="navbar-toggler hamburger hamburger--squeeze" type="button" data-toggle="collapse" data-target="#nav-collapse">
        <span class="hamburger-box">
            <span class="hamburger-inner"></span>
        </span>
    </button>
    <div class="collapse navbar-collapse" id="nav-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-link">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="darkSwitch">
                    <label class="custom-control-label" for="darkSwitch">Dark Mode</label>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../index.php?content=login">Log in</a>
            </li>
            <li class="nav-item">
                <a href="../index.php?content=registreer_zzp">
                    <button class="btn btn-primary">Registreer</button>
                </a>
            </li>
        </ul>
    </div>
</nav>