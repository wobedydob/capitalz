<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">ZZP.nl</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">Log in</a>
        </li>
        <li class="nav-item">
            <a href="./pages/registration_bedrijf.php">
                <button class="btn btn-primary">Registreer</button>
            </a>
        </li>
    </ul>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-blue">

    <ul class="navbar-nav mx-auto">

        <form method="post" action="">
            <div class="form-row">

                <div class="col">
                    <div class="input-group">

                        <div class="input-group-prepend">
                            <div class="input-group-text">Wat:</div>
                        </div>

                        <input type="text" class="form-control" id="trefwoorden" placeholder="Trefwoorden">

                    </div>
                </div>

                <div class="col-5">
                    <div class="input-group">

                        <div class="input-group-prepend">
                            <div class="input-group-text">Waar:</div>
                        </div>

                        <select class="custom-select" id="locatie">
                            <option selected>Kies Locatie...</option>
                            <option value="1">Amsterdam</option>
                            <option value="2">Den Haag</option>
                            <option value="3">Rotterdam</option>
                            <option value="4">Utrecht</option>
                        </select>

                    </div>
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-secondary">Zoeken</button>
                </div>

            </div>
        </form>

    </ul>

</nav>