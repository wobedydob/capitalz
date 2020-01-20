<?php

include('autoloader.php');

class RegisterPage
{
    private $urlArr;
    public $zzpForm;
    public $bedrijfForm;

    public $formMessage;

    public function __construct($urlArr)
    {
        $this->urlArr = $urlArr;

        // Selecting the first value in the pageVars array
        if ($urlArr['pageVars'][0] == 'zzp') {
            $this->register_zzp();
        } else if ($urlArr['pageVars'][0] == 'bedrijf') {
            $this->register_bedrijf();
        } else {
            header("Refresh: 2; url=" . $urlArr['baseUrl'] . "home");
        }

    }

    private function register_zzp()
    {
        if (isset($_POST['reg_submit'])) {
            $email = ApplicationController::sanitize($_POST['email']);
            $password = ApplicationController::sanitize($_POST['password']);
            $repeat_password = ApplicationController::sanitize($_POST['repeat_password']);
            $btw_nummer = ApplicationController::sanitize($_POST['number']);
//            var_dump($_POST);
            if (isset($email)) {
                $db = new Database();
                $db->query("SELECT * from `user` WHERE `email` = :email");
                $db->bind(':email', $email);
//                var_dump('SELECT * from `user` WHERE `email` = :email');
//                var_dump($email);
                $db->execute();

                if ($repeat_password == $password) {
                    if ($db->rowCount() > 0) {
                        $this->formMessage = '<div class="alert alert-danger" role="alert">Dit e-mail adres is al in gebruik</div>';
                    } else {
                        $password_hash = password_hash($password, PASSWORD_BCRYPT);
                        $db = new Database();
                        $db->query("INSERT INTO `user` (`email`, `password`, `number`, `user_role`) VALUES(:email, :password_hash, :btw_nummer, 2)");
                        $db->bind(':email', $email);
                        $db->bind(':password_hash', $password_hash);
                        $db->bind(':btw_nummer', $btw_nummer);
                        $db->execute();
                        $this->formMessage = '<div class="alert alert-success" role="alert">Je bent geregistreerd, je kan nu inloggen</div>';
                        header("refresh:1; url=" . $this->urlArr['baseUrl'] . "login");
                    }
                } else {
                    $this->formMessage = '<div class="alert alert-danger" role="alert">De wachtwoorden komen niet overeen</div>';
                }
            }
        }
        $this->zzpForm = ApplicationController::get_part_string(
            'register/zzp',
            array(
                'baseUrl' => $this->urlArr['baseUrl'],
                'formMessage' => $this->formMessage)
        );
    }

    private function register_bedrijf()
    {
        if (isset($_POST['reg_submit'])) {
            $email = ApplicationController::sanitize($_POST['email']);
            $password = ApplicationController::sanitize($_POST['password']);
            $repeat_password = ApplicationController::sanitize($_POST['repeat_password']);
            $kvk_nummer = ApplicationController::sanitize($_POST['number']);
            if (isset($email)) {
                $db = new Database();
                $db->query("SELECT * from `user` WHERE `email` = :email");
                $db->bind(':email', $email);
//                var_dump('SELECT * from `user` WHERE `email` = :email');
//                var_dump($email);
                $db->execute();

                if ($repeat_password == $password) {
                    if ($db->rowCount() > 0) {
                        $this->formMessage = '<div class="alert alert-danger" role="alert">Dit e-mail adres is al in gebruik</div>';
                    } else {
                        $password_hash = password_hash($password, PASSWORD_BCRYPT);
                        $db = new Database();
                        $db->query("INSERT INTO `user` (`email`, `password`, `number`, `user_role`) VALUES(:email, :password_hash, :kvk_nummer, 1)");
                        $db->bind(':email', $email);
                        $db->bind(':password_hash', $password_hash);
                        $db->bind(':kvk_nummer', $kvk_nummer);
                        $db->execute();
                        $this->formMessage = '<div class="alert alert-success" role="alert">U bent geregistreerd! Een admin controleerd uw aanmelding. U zult dan een bevestigings mail ontvangen.</div>';
                        header("refresh:1; url=" . $this->urlArr['baseUrl'] . "login");
                    }
                } else {
                    $this->formMessage = '<div class="alert alert-danger" role="alert">De wachtwoorden komen niet overeen</div>';
                }
            }
        }
        $this->bedrijfForm = ApplicationController::get_part_string(
            'register/bedrijf',
            array(
                'baseUrl' => $this->urlArr['baseUrl'],
                'formMessage' => $this->formMessage)
        );
    }
}