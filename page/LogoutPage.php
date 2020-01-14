<?php

class LogoutPage
{
    private $urlArr;

    public function __construct($urlArr)
    {
        $this->urlArr = $urlArr;

        unset($_SESSION["user_role"]);
        header("Refresh: 1; url=" . $urlArr['baseUrl'] . "home");
    }
}
