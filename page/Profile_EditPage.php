<?php

class Profile_EditPage
{
    public $zzpForm;
    public $bedrijfForm;

    private $urlArr;

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
            $about = ApplicationController::sanitize($_POST['about']);
            $cv_file = ApplicationController::sanitize($_POST['cv']);
            $pro_pic = ApplicationController::sanitize($_POST['pro-pic']);
//            $btw_number = ApplicationController::sanitize($_SESSION['number']);

            if ($_FILES['pro-pic']['name'] != "") {
                $target_dir = "img/profile/";
                $file = $_FILES['pro-pic']['name'];
                $path = pathinfo($file);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['pro-pic']['tmp_name'];
                $path_filename_ext = $target_dir . $filename . "." . $ext;
                if (file_exists($path_filename_ext)) {
                    echo 'File already exists.';
                } else {
                    move_uploaded_file($temp_name, $path_filename_ext);
                }
            }

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
                    header("refresh:2; url=/home");
                    die('<div class="alert alert-danger" role="alert">Dit profiel is al aangemaakt</div>');
                } else {
                    $db = new Database();
                    $db->query('INSERT INTO `profile_se` (`user_id`, `firstname`, `infix`, `lastname`, `birthday`, `gender`, `nationality`, `about`, `cv_file`, `pro_img`) VALUES (:user_id, :firstname, :infix, :lastname, :birthday, :gender, :nationality, :about, :cv_file, :pro_img);');
                    $db->bind(':user_id', $user_id);
                    $db->bind(':firstname', $firstname);
                    $db->bind(':infix', $infix);
                    $db->bind(':lastname', $lastname);
                    $db->bind(':birthday', $birthday);
                    $db->bind(':gender', $gender);
                    $db->bind(':nationality', $nationality);
                    $db->bind(':about', $about);
//                    $db->bind(':btw_nummer', $btw_number);
                    $db->bind(':cv_file', $cv_file);
                    $db->bind(':pro_img', $pro_pic);
//                    var_dump($db);
                    $db->execute();
                    echo '<div class="alert alert-success" role="alert">Je hebt je profiel geupdate!</div>';
                    header("refresh:1; url=../home");
                }
            }
        }
    }

    private function profile_edit_bedrijf()
    {
        $this->bedrijfForm = ApplicationController::get_part_string('profile_edit/bedrijf', array('baseUrl' => $this->urlArr['baseUrl']));
        if (isset($_POST['pro_edit_submit'])) {
            $user_id = ApplicationController::sanitize($_SESSION['id']);
            $company_name = ApplicationController::sanitize($_POST['company_name']);
            $state = ApplicationController::sanitize($_POST['state']);
            $city = ApplicationController::sanitize($_POST['city']);
            $address = ApplicationController::sanitize($_POST['address']);
            $postal = ApplicationController::sanitize($_POST['postal']);
            $about = ApplicationController::sanitize($_POST['about']);
            $site = ApplicationController::sanitize($_POST['site']);
            $pro_pic = ApplicationController::sanitize($_POST['pro-pic']);
//            $kvk_nummer = ApplicationController::sanitize($_SESSION['number']);


//            var_dump($_POST);
//            var_dump($_SESSION);

            if (isset($user_id)) {
                $db = new Database();
                $db->query('SELECT `number` FROM `user` WHERE `user_id` = :user_id');
                $db->bind(':user_id', $user_id);
                $db->execute();

                if ($db->rowCount() < 1) {
                    header("refresh:2; url=/home");
                    die('<div class="alert alert-danger" role="alert">Dit profiel is al aangemaakt</div>');
                } else {
                    $db = new Database();
                    $db->query('INSERT INTO `profile_co` (`user_id`, `company_name`, `state`, `city`,`address`,`postal`, `about`, `website`, `pro_img`) VALUES (:user_id, :company_name, :state, :city,:address,:postal, :about, :site, :pro_img)');
                    $db->bind(':user_id', $user_id);
                    $db->bind(':company_name', $company_name);
                    $db->bind(':state', $state);
                    $db->bind(':city', $city);
                    $db->bind(':address', $address);
                    $db->bind(':postal', $postal);
                    $db->bind(':about', $about);
                    $db->bind(':site', $site);
//                    $db->bind(':kvk_nummer', $kvk_nummer);
                    $db->bind(':pro_img', $pro_pic);
                    $db->execute();

                    echo '<div class="alert alert-success" role="alert">Je hebt je profiel geupdate!</div>';
                    header("refresh:1; url=../home");
                }
            }
        }
    }
}