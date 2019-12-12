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
            $bnummer = ApplicationController::sanitize($_POST['bnummer']);

            if (!isset($email)) {
                $db = new Database();
                $db->query("SELECT * from `user` WHERE `email` = ':email'");
                $db->bind(':email', $email);

                $db->execute();
                var_dump($db->resultset());
                exit;

                if (mysqli_num_rows($result) > 0) {
                    header("refresh:2; url=./index.php?content=register");
                    die('<div class="alert alert-danger" role="alert">
        Dit e-mail adres is al in gebruik
      </div>');
                } else {
                    $password = 'geheim';
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);

                    $db = new Database();
                    $db->query("INSERT INTO `user` (`user_id`,
                                    `email`,
                                    `password`,
                                    `userrole`)
                            VALUES (NULL,
                                    '$email',
                                    'geheim',
                                    'selfemployed')");

                    $result = mysqli_query($conn, $sql);

                }
            }
        }
    }

    private
    function register_bedrijf()
    {
        $this->bedrijfForm = ApplicationController::get_part_string('register/bedrijf', array('baseUrl' => $this->urlArr['baseUrl']));
//        if (isset($_POST['reg_submit'])) {
//            $email = $_POST['email'];
//            $password = $_POST['password'];
//            $repeat_password = $_POST['repeat_password'];
//            $kvknummer = $_POST['kvknummer'];
//            var_dump($_POST);
    }
}