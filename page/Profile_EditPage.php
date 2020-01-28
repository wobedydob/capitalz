<?php

class Profile_EditPage
{
    public $zzpForm;
    public $bedrijfForm;
    public $formMessage;

    private $urlArr;

    public function __construct($urlArr)
    {
        $this->urlArr = $urlArr;

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
        $this->zzpForm = ApplicationController::get_part_string('profile_edit/zzp', array('baseUrl' => $this->urlArr['baseUrl'], 'formMessage' => $this->formMessage));
        if (isset($_POST['pro_edit_submit'])) {
            $user_id = ApplicationController::sanitize($_SESSION['id']);
            $firstname = ApplicationController::sanitize($_POST['firstname']);
            $infix = ApplicationController::sanitize($_POST['infix']);
            $lastname = ApplicationController::sanitize($_POST['lastname']);
            $birthday = ApplicationController::sanitize($_POST['birthday']);
            $gender = ApplicationController::sanitize($_POST['gender']);
            $nationality = ApplicationController::sanitize($_POST['nationality']);
            $about = ApplicationController::sanitize($_POST['about']);
            if (!empty($_FILES['cv']['name'])) {
                $target_dir = "documents/cv/";
                $file = $_FILES['cv']['name'];
                $path = pathinfo($file);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['cv']['tmp_name'];
                $path_filename_ext = $target_dir . $filename . "." . $ext;
                if (file_exists($path_filename_ext)) {
                    $this->formMessage = '<div class="alert alert-danger" role="alert">Dit cv is al geupload!</div>';
                } else {
                    move_uploaded_file($temp_name, $path_filename_ext);
                    $cv_file = ApplicationController::sanitize($_FILES['cv']['name']);
                }
            } else {
                $cv_file = null;
            }
            if (!empty($_FILES['pro-pic']['name'])) {
                $target_dir = "img/profile/";
                $file = $_FILES['pro-pic']['name'];
                $path = pathinfo($file);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['pro-pic']['tmp_name'];
                $path_filename_ext = $target_dir . $filename . "." . $ext;
                if (file_exists($path_filename_ext)) {
                    $this->formMessage = '<div class="alert alert-danger" role="alert">Deze profiel foto bestaat al!</div>';
                } else {
                    move_uploaded_file($temp_name, $path_filename_ext);
                    $pro_pic = ApplicationController::sanitize($_FILES['pro-pic']['name']);
                }
            } else {
                $pro_pic = null;
            }
//            $btw_number = ApplicationController::sanitize($_SESSION['number']);

            if (isset($user_id)) {
                $db = new Database();
                $db->query("SELECT `number` from `user` WHERE `user_id` = :user_id");
                $db->bind(':user_id', $user_id);
                $db->execute();

                if ($db->rowCount() < 1) {
                    $this->formMessage = '<div class="alert alert-danger" role="alert">Dit profiel bestaat al!</div>';
                    header("Refresh: 1; url=" . $this->urlArr['baseUrl'] . "home");
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
                    $db->execute();
                    $this->formMessage = '<div class="alert alert-danger" role="alert">Je profiel is geupdate!</div>';
                    header("Refresh: 1; url=" . $this->urlArr['baseUrl'] . "home");
                }
            }
        }
    }

    private function profile_edit_bedrijf()
    {
        $this->bedrijfForm = ApplicationController::get_part_string('profile_edit/bedrijf', array('baseUrl' => $this->urlArr['baseUrl'], 'formMessage' => $this->formMessage));
        if (isset($_POST['pro_edit_submit'])) {
            $user_id = ApplicationController::sanitize($_SESSION['id']);
            $company_name = ApplicationController::sanitize($_POST['company_name']);
            $state = ApplicationController::sanitize($_POST['state']);
            $city = ApplicationController::sanitize($_POST['city']);
            $address = ApplicationController::sanitize($_POST['address']);
            $postal = ApplicationController::sanitize($_POST['postal']);
            $about = ApplicationController::sanitize($_POST['about']);
            $site = ApplicationController::sanitize($_POST['site']);
            if (!empty($_FILES['pro-pic']['name'])) {
                $target_dir = "img/profile/";
                $file = $_FILES['pro-pic']['name'];
                $path = pathinfo($file);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['pro-pic']['tmp_name'];
                $path_filename_ext = $target_dir . $filename . "." . $ext;
                if (file_exists($path_filename_ext)) {
                    $this->formMessage = '<div class="alert alert-danger" role="alert">Deze profiel foto bestaat al!</div>';
                } else {
                    move_uploaded_file($temp_name, $path_filename_ext);
                    $pro_pic = ApplicationController::sanitize($_FILES['pro-pic']['name']);
                }
            }
//            $kvk_nummer = ApplicationController::sanitize($_SESSION['number']);

            if (isset($user_id)) {
                $db = new Database();
                $db->query('SELECT `number` FROM `user` WHERE `user_id` = :user_id');
                $db->bind(':user_id', $user_id);
                $db->execute();

                if ($db->rowCount() < 1) {
                    $this->formMessage = '<div class="alert alert-danger" role="alert">Dit profiel bestaat al!</div>';
                    header("Refresh: 1; url=" . $this->urlArr['baseUrl'] . "home");
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
                    $this->formMessage = '<div class="alert alert-danger" role="alert">Je profiel is geupdate!</div>';
                    header("Refresh: 1; url=" . $this->urlArr['baseUrl'] . "home");
                }
            }
        }
    }
}