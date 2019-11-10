<div id="particles-js"></div>
<div class="container register center invis">
    <h1 class="register-head normal selection">Registreren Zzp'er</h1>
    <hr>
    <form>
        <!--Email row-->
        <div class="form-row">
            <div class="form-group col-12">
                <label class="normal" for="email">E-mail:</label><span class="required">*</span>
                <div class="normal input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-at"></i></div>
                    </div>
                    <input type="email" class="form-control" id="email" placeholder="E-mail" required>
                </div>
                <span class="normal register-detail">Voer een geldig email in, u krijgt een verificatie mail.</span>
            </div>
        </div>
        <!--Wachtwoord row-->
        <div class="form-row">
            <div class="form-group col-12 col-md-6">
                <label class="normal" for="wachtwoord1">Wachtwoord:</label><span class="required">*</span>
                <div class="normal input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-key"></i></div>
                    </div>
                    <input type="password" class="form-control" id="wachtwoord1" placeholder="Wachtwoord" minlength="8" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-eye"></i></div>
                    </div>
                </div>
                <span class="normal register-detail">Het wachtwoord moet minstens 8 karakters lang zijn en 1 speciaal karakter bevatten.</span>
            </div>
            <div class="form-group col-12 col-md-6">
                <label class="normal" for="wachtwoord2">Herhaal wachtwoord:</label><span class="required">*</span>
                <div class="normal input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-key"></i></div>
                    </div>
                    <input type="password" class="form-control" id="wachtwoord2" placeholder="Wachtwoord" minlength="8" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-eye"></i></div>
                    </div>
                </div>
                <span class="normal register-detail">Herhaal het wachtwoord ter controle.</span>
            </div>
        </div>
        <!--belasting row-->
        <div class="form-row">
            <div class="form-group col-12 col-md-12">
                <label class="normal" for="bnummer">Btw-identificatienummer:</label><span class="required">*</span>
                <div class="normal input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-address-book"></i></div>
                    </div>
                    <input type="text" class="form-control normal" id="bnummer" placeholder="Bijvoorbeeld: NL-001234567-B34:">
                </div>
                <span class="normal register-detail">Voer uw btw-identificatienummer in.</span>
            </div>
        </div>
        <!--Register button-->
        <hr class="hr-bottom">
        <div class="reg-btn-row">
            <button type="submit" class="btn reg-btn btn-primary normal ">Registreer</button>
        </div>
        <h6 class="normal reg-bedr">Of bent u eigenaar van een bedrijf? Klik dan <a href="../index.php?content=registreer_bedrijf">hier</a>.</h6>
    </form>
</div>