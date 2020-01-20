<?php

class UserController extends UserModel
{

    public function __construct(int $userId = 0, string $email = '', string $password = '')
    {
        if (!empty($userId)) $this->set_userId($userId);
        if (!empty($email)) $this->set_email($email);
        if (!empty($password)) $this->set_password($password);
    }

    public function register()
    {

    }

    public function login()
    {

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

        if ($db->execute() && $db->single()) {
            return $db->single()['pro_img'];
        } else {
            return $table . '.png';
        }
    }
}