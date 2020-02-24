<?php

class ValidatePage
{
    public function __construct()
    {

    }

    public static function check_code($user_id)
    {
        $db = new Database();
        $db->query("SELECT `code` FROM `user` WHEHE `user_id` == . '$user_id' . ");
    }
}