<?php

class ProfilePage
{
    public $zzpForm;
    public $bedrijfForm;
    public $profileForm;

    private $urlArr;

    public function __construct($urlArr)
    {
        $this->urlArr = $urlArr;
        if (empty($urlArr['pageVars'][0])) {
            header("Refresh: 2; url=" . ApplicationController::getInstance()->url('home') . "");
        } elseif ($urlArr['pageVars'][0] == 'zzp') {
            $this->get_profile('zzp');
        } elseif ($urlArr['pageVars'][0] == 'bedrijf') {
            $this->get_profile('bedrijf');
        } else {
            header("Refresh: 2; url=" . ApplicationController::getInstance()->url('home') . "");
        }
    }

    private function get_profile($type)
    {
        if ($type == null) {
            header("Refresh: 2; url=" . ApplicationController::getInstance()->url('home') . "");
            return (isset($this->pageObj->profileForm)) == false;
        } elseif ($type == 'zzp') {
            $table = 'profile_se';
        } elseif ($type == 'bedrijf') {
            $table = 'profile_co';
        } else {
            header("Refresh: 2; url=" . ApplicationController::getInstance()->url('home') . "");
            return (isset($this->pageObj->profileForm)) == false;
        }
//        if (isset($_GET["id"])) {
//            $id = ($_GET["id"]);
//        }
        $db = new Database();
        $db->query('SELECT
	                            `user`.*,
                                `profile`.*
                            FROM `user`
                            LEFT JOIN ' . $table . ' AS `profile` USING(user_id)
                            WHERE `user`.`user_id` = :userId;');
        $db->bind(':userId', ApplicationController::sanitize($_SESSION['id']));

//        if ($db->single()['gender'] === 'm') {
//            $gender = 'Man';
//        } elseif ($db->single()['gender'] === 'f') {
//            $gender = 'Vrouw';
//        } elseif ($db->single()['gender'] === 'o') {
//            $gender = 'Overig';
//        } else {
//            $gender = 'Overig';
//        }
//        var_dump($gender);
//        $db->single()['gender'] = $gender;
//        var_dump($db->single()['gender'] = $gender);

        if ($userInfo = $db->single()) {
            return $this->profileForm = ApplicationController::get_part_string(
                'profile/' . $type,
                array(
                    'baseUrl' => $this->urlArr['baseUrl'],
                    'userInfo' => $userInfo)
            );
        }
        header("Refresh: 2; url=" . ApplicationController::getInstance()->url('home') . "");
        return (isset($this->pageObj->profileForm)) == false;
    }

    private function profile_zzp()
    {
        $this->zzpForm = ApplicationController::get_part_string(
            'profile/zzp',
            array(
                'baseUrl' => $this->urlArr['baseUrl'])
        );
//        $user_id = ApplicationController::sanitize($_SESSION['id']);
    }


    private function profile_bedrijf()
    {
        $this->bedrijfForm = ApplicationController::get_part_string(
            'profile/bedrijf',
            array(
                'baseUrl' => $this->urlArr['baseUrl'])
        );
    }
}