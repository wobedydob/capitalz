<?php

class Profile_EditPage
{
    private $urlArr;
    public $zzpForm;
    public $bedrijfForm;

    public function __construct($urlArr)
    {
        $this->urlArr = $urlArr;

        // Selecting the first value in the pageVars array
        if ($urlArr['pageVars'][0] == 'zzp') {
            $this->profile_edit_zzp();
        } else if ($urlArr['pageVars'][0] == 'bedrijf') {
            $this->profile_edit_bedrijf();
        } else {
            header("Refresh: 2; url=" . $urlArr['baseUrl'] . "home");
        }

    }

    private function profile_edit_zzp()
    {
        $this->zzpForm = ApplicationController::get_part_string('profile_edit/zzp', array('baseUrl' => $this->urlArr['baseUrl']));
        if (isset($_POST['pro_edit_submit'])) {
            $user_id = ApplicationController::sanitize($_SESSION['id']);
            $firstname = ApplicationController::sanitize($_POST['firstname']);
            $infix = ApplicationController::sanitize($_POST['infix']);
            $lastname = ApplicationController::sanitize($_POST['lastname']);
            $birthday = ApplicationController::sanitize($_POST['birthday']);
            $gender = ApplicationController::sanitize($_POST['gender']);
            $nationality = ApplicationController::sanitize($_POST['nationality']);
            $desc = ApplicationController::sanitize($_POST['desc']);
            $cv_file = ApplicationController::sanitize($_POST['cv']);
            $pro_pic = ApplicationController::sanitize($_POST['pro-pic']);
            $btw_nummer = ApplicationController::sanitize($_SESSION['number']);

            var_dump($_POST);

            if (isset($user_id)) {
                $db = new Database();
                $db->query("SELECT `number` from `user` WHERE `user_id` = :user_id");
                $db->bind(':user_id', $user_id);
//                var_dump('SELECT * from `user` WHERE `email` = :email');
//                var_dump($user_id);
                $db->execute();
//                var_dump($db->rowCount() < 1);
//                var_dump($db);

                if ($db->rowCount() < 1) {

                    header("refresh:2; url=/profile_edit");
                    die('<div class="alert alert-danger" role="alert">Dit e-mail adres is al in gebruik</div>');
                } else {
                    $db = new Database();
//                    $db->query("INSERT INTO `profile_se` (`user_id`, `firstname`, `infix`, `lastname`, `birthday`, `gender`, `nationality`, `about`, `btw_nummer`, `cv_file`, `pro_img`) VALUES(:user_id, :firstname, :infix, :lastname, :birthday, :gender, :nationality, :cv_file, :pro_img)");
                    $db->query("INSERT INTO `profile_se` (`user_id`, `firstname`, `infix`, `lastname`, `birthday`, `gender`, `nationality`, `about`, `btw_nummer`, `cv_file`, `pro_img`)
                                       VALUES (:user_name, :firstname, :infix, :lastname, :birthday, :gender, :nationality, :about, :btw_nummer, NULL, NULL);");
                    $db->bind(':user_id', $user_id);
                    $db->bind(':firstname', $firstname);
                    $db->bind(':infix', $infix);
                    $db->bind(':lastname', $lastname);
                    $db->bind(':birthday', $birthday);
                    $db->bind(':gender', $gender);
                    $db->bind(':nationality', $nationality);
                    $db->bind(':about', $desc);
                    $db->bind(':btw_nummer', $btw_nummer);
                    $db->bind(':cv_file', $cv_file);
                    $db->bind(':pro_img', $pro_pic);
                    $db->execute();
//                    var_dump($db);
                    echo '<div class="alert alert-success" role="alert">Je bent geregistreerd, je kan nu inloggen</div>';
                    header("refresh:1; url=../login");
                }
            }
        }
    }


//        if (isset($_POST['profile_submit'])) {
//            $name = ApplicationController::sanitize($_POST['name']);
//            $birthday = ApplicationController::sanitize($_POST['birthday']);
//            $gender = ApplicationController::sanitize($_POST['gender']);
//            $nationality = ApplicationController::sanitize($_POST['nationality']);
//
//            $db = new Database();
//            $db->query("INSERT INTO `user_profile` (`name`, `birthday`, `gender`, `nationality`) VALUES(:user_name, :birthday, :gender, :nationality)");
//            $db->bind(':name', $name);
//            $db->bind(':birthday', $birthday);
//            $db->bind(':gender', $gender);
//            $db->bind(':nationality', $nationality);
//            $db->execute();
//
//        } else {
//            echo 'daar ging wat mis';
//        }
//    }

    private function profile_edit_bedrijf()
    {
        $this->bedrijfForm = ApplicationController::get_part_string('profile_edit/bedrijf', array('baseUrl' => $this->urlArr['baseUrl']));
    }
}