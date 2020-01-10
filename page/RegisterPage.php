<?php

include('autoloader.php');

class RegisterPage
{
    private $urlArr;
    public $zzpForm;
    public $bedrijfForm;

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
        $this->zzpForm = ApplicationController::get_part_string('register/zzp', array('baseUrl' => $this->urlArr['baseUrl']));
        if (isset($_POST['reg_submit'])) {
            $email = ApplicationController::sanitize($_POST['email']);
            $password = ApplicationController::sanitize($_POST['password']);
            $repeat_password = ApplicationController::sanitize($_POST['repeat_password']);
            $btw_nummer = ApplicationController::sanitize($_POST['btw_nummer']);
            if (isset($email)) {
                $db = new Database();
                $db->query("SELECT * from `user` WHERE `email` = :email");
                $db->bind(':email', $email);
//                var_dump('SELECT * from `user` WHERE `email` = :email');
//                var_dump($email);
                $db->execute();

                if ($repeat_password == $password) {
                    if ($db->rowCount() > 0) {
                        header("refresh:2; url=/login");
                        die('<div class="alert alert-danger" role="alert">
                            Dit e-mail adres is al in gebruik
                         </div>');
                    } else {
                        $password_hash = password_hash($password, PASSWORD_BCRYPT);
                        $db = new Database();
                        $db->query("INSERT INTO `user` (`email`, `password`, `userrole`) VALUES(:email, :password_hash, 2)");
                        $db->bind(':email', $email);
                        $db->bind(':password_hash', $password_hash);
                        $db->execute();
                        $userId = $db->lastInsertId();
                        $db->query("INSERT INTO `user_info` (`user_id`, `key`, `value`) VALUES(:user_id, 'btw-nummer', :btw_nummer)");
                        $db->bind(':user_id', $userId);
                        $db->bind(':btw_nummer', $btw_nummer);
                        $db->execute();
//                    var_dump($db);
                        echo '<div class="alert alert-success" role="alert">
                                    Je bent geregistreerd, je kan nu inloggen
                              </div>';
                        header("refresh:1; url=../login");
                    }
                } else {
                    echo 'De wachtwoorden komen niet overeen';
                }
            }
        }
    }

    private function register_bedrijf()
    {
        $this->bedrijfForm = ApplicationController::get_part_string('register/bedrijf', array('baseUrl' => $this->urlArr['baseUrl']));
        if (isset($_POST['reg_submit'])) {
            $email = ApplicationController::sanitize($_POST['email']);
            $password = ApplicationController::sanitize($_POST['password']);
            $repeat_password = ApplicationController::sanitize($_POST['repeat_password']);
            $kvk_nummer = ApplicationController::sanitize($_POST['kvk_nummer']);
            if ($repeat_password == $password) {
                if (isset($email)) {
                    $db = new Database();
                    $db->query("SELECT * from `user` WHERE `email` = :email");
                    $db->bind(':email', $email);
//                var_dump('SELECT * from `user` WHERE `email` = :email');
//                var_dump($email);
                    $db->execute();

                    if ($db->rowCount() > 0) {
                        header("refresh:2; url=/create");
                        die('<div class="alert alert-danger" role="alert">
                            Dit e-mail adres is al in gebruik
                         </div>');
                    } else {
                        $password = 'geheim';
                        $password_hash = password_hash($password, PASSWORD_BCRYPT);
                        $db = new Database();
                        $db->query("INSERT INTO `user` (`email`, `password`, `userrole`) VALUES(:email, :password_hash, 1)");
                        $db->bind(':email', $email);
                        $db->bind(':password_hash', $password_hash);
                        $db->execute();
                        $userId = $db->lastInsertId();
                        $db->query("INSERT INTO `user_info` (`user_id`, `key`, `value`) VALUES(:user_id, 'kvk-nummer', $kvk_nummer)");
                        $db->bind(':user_id', $userId);
                        $db->execute();
//                    var_dump($db);
                        echo '<div class="alert alert-success" role="alert">
                        Je bent geregistreerd, je kan nu inloggen
                              </div>';
                    }
                } else {
                    echo 'De wachtwoorden komen niet overeen';
                }
            }
        }
    }
}