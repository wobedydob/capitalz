<?php

class RegisterPage
{
    public $zzpForm;
    public $bedrijfForm;
    public $formMessage;

    private $urlArr;

    public function __construct($urlArr)
    {
        $this->urlArr = $urlArr;
        if (empty($urlArr['pageVars'][0])) {
            header("Refresh: 2; url=" . ApplicationController::getInstance()->url('home') . "");
        } elseif ($urlArr['pageVars'][0] == 'zzp') {
            $this->register_zzp();
        } elseif ($urlArr['pageVars'][0] == 'bedrijf') {
            $this->register_bedrijf();
        } else {
            header("Refresh: 2; url=" . ApplicationController::getInstance()->url('home') . "");
        }
    }

    private function register_zzp()
    {
        if (isset($_POST['reg_submit'])) {
            $email = ApplicationController::sanitize($_POST['email']);
            $password = ApplicationController::sanitize($_POST['password']);
            $repeat_password = ApplicationController::sanitize($_POST['repeat_password']);
            $btw_nummer = ApplicationController::sanitize($_POST['number']);

            if (isset($email)) {
                $db = new Database();
                $db->query("SELECT * from `user` WHERE `email` = :email");
                $db->bind(':email', $email);
                $db->execute();

                if (!empty($email)) {
                    if (!empty($password)) {
                        if (!empty($repeat_password)) {
                            if (strlen($password) >= 8) {
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
                                        $this->formMessage = '<div class="alert alert-success" role="alert">Registratie geslaagd! U wordt doorverwezen.</div>';
//                                        $db->query('SELECT `user_id` FROM `user`');
//                                        $db->execute();
//                                        UserController::set_code((int)$user_id);
                                        header("refresh:1; url=" . ApplicationController::getInstance()->url('validate') . "");
                                    }
                                } else {
                                    $this->formMessage = '<div class="alert alert-danger" role="alert">De wachtwoorden komen niet overeen</div>';
                                }
                            } else {
                                $this->formMessage = '<div class="alert alert-danger" role="alert">Het wachtwoord moet minstens 8 karakters lang zijn</div>';
                            }
                        } else {
                            $this->formMessage = '<div class="alert alert-danger" role="alert">Herhaal je wachtwoord!</div>';
                        }
                    } else {
                        $this->formMessage = '<div class="alert alert-danger" role="alert">Voer een wachtwoord in!</div>';
                    }
                } else {
                    $this->formMessage = '<div class="alert alert-danger" role="alert">Voer een email in!</div>';
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
                        header("refresh:1; url=" . ApplicationController::getInstance()->url('validate') . "");
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