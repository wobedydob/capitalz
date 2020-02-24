<?php

class UserController extends UserModel
{
    public $pageObj;

    public function __construct(int $userId = 0, string $email = '', string $password = '')
    {
        if (!empty($userId)) $this->set_userId($userId);
        if (!empty($email)) $this->set_email($email);
        if (!empty($password)) $this->set_password($password);
    }

    public static function get_profile_picture($user_id, $user_role)
    {
        if ($user_role == 1) {
            $table = 'profile_co';
        } elseif ($user_role == 2) {
            $table = 'profile_se';
        } else {
            return 'profile_ad.png';
        }

        $db = new Database();
        $db->query('SELECT pro_img FROM ' . $table . ' WHERE user_id = :user_id');
        $db->bind(':user_id', $user_id);

        if ($db->execute() && $db->single()['pro_img']) {
            $img = 'profile/' . $db->single()['pro_img'];
        } else {
            $img = 'default_profile/' . $table;
        }

        return $img;
    }

    public static function get_profile_cv($user_id)
    {
        $db = new Database();
        $db->query('SELECT cv_file FROM profile_se WHERE user_id = :user_id');
        $db->bind(':user_id', $user_id);

        if ($db->execute() && $db->single()['cv_file']) {
            return ApplicationController::getInstance()->url('cv/') . $db->single()['cv_file'];
        } else {
            return 'Deze user heeft geen CV geupload';
        }
    }

    public static function get_profile_name($user_id, $user_role)
    {
        $db = new Database();
        if ($user_role == 0) {
            return 'Admin';
        } elseif ($user_role == 1) {
            $db->query('SELECT company_name FROM profile_co WHERE user_id = :user_id');
            $db->bind(':user_id', $user_id);
            if ($db->execute() && $db->single()['company_name']) {
                return $db->single()['company_name'];
            }
        } elseif ($user_role == 2) {
            $db->query('SELECT firstname FROM profile_se WHERE user_id = :user_id');
            $db->bind(':user_id', $user_id);
            if ($db->execute() && $db->single()['firstname']) {
                return $db->single()['firstname'];
            }
        } else {
            return 'ERROR';
        }
        if ($user_role == 1) {
            return 'Bedrijf';
        } elseif ($user_role == 2) {
            return 'ZZP\'er';
        } else {
            return 'ERROR';
        }
    }

    public static function get_validation()
    {
        return true;
    }

    public static function set_code($user_id)
    {
        $rand = rand(0, 9999);
        $code = str_pad($rand, 4, "0", STR_PAD_LEFT);
        $db = new Database();
        $db->query("INSERT INTO `user` (`code`) VALUES(:code) WHERE `user_id` == . '$user_id' . ");
        $db->bind(':code', $code);
        $db->execute();
    }

    public function send_email()
    {

    }
}