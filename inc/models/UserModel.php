<?php

class UserModel
{

    private $userId;
    private $email;
    private $password;
    private $role;
    private $infoArr;

//    =================================================================================================================================================
//    GETTERS
//    =================================================================================================================================================

    private function get_userId()
    {
        return $this->userId;
    }

    private function get_email()
    {
        return $this->email;
    }

    private function get_password()
    {
        return $this->password;
    }

    private function get_role()
    {
        return $this->role;
    }

//    =================================================================================================================================================
//    SETTERS
//    =================================================================================================================================================

    protected function set_userId($userId)
    {
        $this->userId = $userId;
    }

    protected function set_email($email)
    {
        $this->email = $email;
    }

    protected function set_password($password)
    {
        $this->password = $password;
    }

    private function set_role($role)
    {
        $this->role = $role;
    }

    private function set_infoArr($infoArr)
    {
        $this->infoArr = $infoArr;
    }

//    =================================================================================================================================================
//    FUNCTIONS
//    =================================================================================================================================================

    function get_infoArr(string $key = '')
    {
        if ($key) return $this->infoArr[$key];
        else return $this->infoArr;
    }

}